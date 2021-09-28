<?php

namespace Components;

use Illuminate\Container\Container;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class EndpointComponent extends Component
{
    public $endpoint;

    public $parameters;

    public $usage;

    public $payload;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $endpoint, string $parameters = null, string $usage = null, string $payload = null)
    {
        $this->parameters = $parameters;
        $this->endpoint = $endpoint;
        $this->usage = $usage;
        $this->payload = $payload;
    }

    public function parametersArray(): array
    {
        if (! $this->parameters) {
            return [];
        }

        $array = json_decode(file_get_contents(__DIR__ . '/../source/_data/parameters/' . $this->parameters . '.json'), true);

        $array = $this->loadSchemaReferences($array);

        return $array;
    }

    public function schemaArray(): array
    {
        if (! $this->payload) {
            return [];
        }

        $array = json_decode(file_get_contents(__DIR__ . '/../source/_data/schemas/' . $this->payload . '.json'), true);

        $array = $this->loadSchemaReferences($array);

        return $array;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return Container::getInstance()
            ->make('view')
            ->make('_components.endpoint');
    }

    private function loadSchemaReferences(array $array): array
    {
        $array = $this->handleIncludeSchema($array);

        for ($i = 0; $i < count($array); $i++) {
            if (array_key_exists('schema', $array[$i])) {
                $schema_name = Str::of($array[$i]['schema'])->before('.');
                $key = Str::of($array[$i]['schema'])->after('.');

                $schema_keys = json_decode(file_get_contents(__DIR__ . '/../source/_data/schemas/' . $schema_name . '.json'), true);

                $schema_keys = $this->loadSchemaReferences($schema_keys);

                $schema_key = array_values(Arr::where($schema_keys, function ($schema_key) use ($key) {
                    if (! array_key_exists('key', $schema_key)) {
                        throw new \Exception('Key not set in schema: ' . print_r($schema_key, 1));
                    }

                    return $key->is($schema_key['key']);
                }));

                if (! count($schema_key)) {
                    throw new \Exception('Key not found in schema: ' . $array[$i]['schema']);
                }

                $array[$i] = array_merge($array[$i], $this->loadSchemaReferences($schema_key)[0]);
                $array[$i]['parameter'] = $array[$i]['key'];
                unset($array[$i]['schema']);
            }
        }

        return $array;
    }

    private function handleIncludeSchema(array $array): array
    {
        $loaded_array = [];
        for ($i = 0; $i < count($array); $i++) {
            if (array_key_exists('includeSchema', $array[$i])) {
                $schema = $array[$i]['includeSchema'];
                $schema_keys = json_decode(file_get_contents(__DIR__ . '/../source/_data/schemas/' . $schema . '.json'), true);

                if (! is_array($schema_keys)) {
                    throw new \Exception('Schema is not an array: ' . $schema);
                }

                $schema_keys = $this->loadSchemaReferences($schema_keys);

                $schema_keys = array_map(function ($schema_key) use ($schema) {
                    if (array_key_exists('key', $schema_key)) {
                        if (! str_contains($schema_key['key'], '.')) {
                            // If the key exists and doesn't already have a schema, prepend the schema
                            $schema_without_folder = Str::of($schema)->afterLast('/');
                            $schema_key['key'] = $schema_without_folder . '.' . $schema_key['key'];
                        }
                    }

                    return $schema_key;
                }, $schema_keys);

                array_push($loaded_array, ...$schema_keys);
            } else {
                $loaded_array[] = $array[$i];
            }
        }

        return $loaded_array;
    }
}
