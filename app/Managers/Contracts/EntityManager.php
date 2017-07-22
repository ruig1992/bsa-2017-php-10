<?php
namespace App\Managers\Contracts;

/**
 * Interface EntityManager
 * @package App\Managers\Contracts
 */
interface EntityManager
{
    /**
     * Find all entities.
     *
     * @param  array $columns
     * @return mixed Collection of entities
     */
    public function findAll(array $columns = ['*']);

    /**
     * Find the entity by its primary key.
     *
     * @param  mixed $id
     * @param  array $columns
     * @return mixed Entity
     */
    public function find($id, array $columns = ['*']);

    /**
     * Find entities with where clause to the query.
     *
     * @param  string|array|\Closure  $column
     * @param  string  $operator
     * @param  mixed   $value
     * @param  string  $boolean
     *
     * @return mixed Collection of entities
     */
    public function findWhere(
        $column,
        string $operator = null,
        $value = null,
        string $boolean = 'and'
    );

    /**
     * Find only first entity with where clause to the query.
     *
     * @param  string|array|\Closure  $column
     * @param  string  $operator
     * @param  mixed   $value
     * @param  string  $boolean
     *
     * @return mixed Entity
     */
    public function findWhereFirst(
        $column,
        string $operator = null,
        $value = null,
        string $boolean = 'and'
    );

    /**
     * Find entities with pagination.
     *
     * @param int $perPage
     * @param array $columns
     * @param bool $simple Simple or full pagination view links
     * @param string $pageName
     * @param int|null $page
     *
     * @return mixed Paginator instance
     */
    public function paginate(
        int $perPage = 15,
        array $columns = ['*'],
        bool $simple = false,
        string $pageName = 'page',
        int $page = null
    );

    /**
     * Create a new entity.
     *
     * @param  array $properties
     * @return mixed Created Entity
     */
    public function create(array $properties);

    /**
     * Update the entity.
     *
     * @param  mixed $id
     * @param  array $properties
     * @return bool
     */
    public function update($id, array $properties): bool;

    /**
     * Delete the entity.
     *
     * @param  mixed $id
     * @return bool
     */
    public function delete($id): bool;
}
