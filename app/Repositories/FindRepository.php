<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class FindRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findBy(array $paramsConfig = [])
    {
        // Configurações padrão
        $defaults = [
            'filters' => [],
            'perPage' => null,
            'groupBy' => null,
            'limit' => null,
            'selects' => ['*'],
            'orderBy' => [], // Espera um array como ['column' => 'direction']
            'withTrashed' => false,
            'onlyTrashed' => false,
            'relations' => [],
            'relationFilters' => [],
            'relationSelects' => [],
            'relationGroupBy' => [],
            'relationLimits' => [],
            'relationOrderBy' => [],
        ];

        // Sobrescrever os padrões com valores fornecidos
        $params = array_merge($defaults, $paramsConfig);
        extract($params);

        $query = $this->model->newQuery();

        // Decidir sobre registros deletados
        if ($onlyTrashed) {
            $query->onlyTrashed();
        } else if ($withTrashed) {
            $query->withTrashed();
        }

        // Aplicar limitação de resultados na consulta principal
        if ($limit) {
            $query->limit($limit);
        }

        // Seleções de colunas na consulta principal
        $query->select($selects);

        // Aplicar ordenação na consulta principal
        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        // Aplicar filtros na consulta principal
        $this->applyFilters($query, $this->model, $filters);

        // Preparar e aplicar configurações nos relacionamentos
        foreach ($relations as $relation) {
            $relationQuery = function ($query) use ($relation, $relationSelects, $relationGroupBy, $relationLimits, $relationFilters, $relationOrderBy) {
                // Selecionar colunas específicas se necessário
                if (!empty($relationSelects[$relation])) {
                    $query->select($relationSelects[$relation]);
                }

                // Aplicar filtros
                if (!empty($relationFilters[$relation])) {
                    $this->applyFilters($query->getQuery(), $query->getRelated(), $relationFilters[$relation]);
                }

                // Aplicar GroupBy se fornecido
                if (!empty($relationGroupBy[$relation])) {
                    $query->groupBy($relationGroupBy[$relation]);
                }

                // Aplicar Limit se fornecido
                if (!empty($relationLimits[$relation])) {
                    $query->limit($relationLimits[$relation]);
                }

                // Aplicar Ordenação no relacionamento
                foreach ($relationOrderBy[$relation] ?? [] as $col => $dir) {
                    $query->orderBy($col, $dir);
                }
            };

            // Adicionar relação com as configurações de query definidas
            $query->with([$relation => $relationQuery]);
        }

        // Aplicar groupBy, se fornecido
        if ($groupBy) {
            $query->groupBy($groupBy);
        }

        // Paginar, se necessário
        if ($perPage) {
            return $this->paginate($query, $perPage);
        }

        return $query->get();
    }

    protected function applyFilters(Builder $query, Model $model, array $filters)
    {
        foreach ($filters as $field => $value) {
            if (method_exists($model, 'scope' . ucfirst($field))) {
                $query->{$field}($value);
            } else {
                $value = is_array($value) ? $value : [$value];
                $query->whereIn($field, $value);
            }
        }
    }

    protected function paginate($query, $perPage)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        return $query->paginate($perPage, ['*'], 'page', $currentPage);
    }
}
