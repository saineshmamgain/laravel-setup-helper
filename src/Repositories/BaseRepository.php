<?php

namespace SaineshMamgain\SetupHelper\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use SaineshMamgain\SetupHelper\Exceptions\RepositoryException;

/**
 * File: Repository.php
 * Date: 06/07/20
 * Author: Sainesh Mamgain <saineshmamgain@gmail.com>.
 */
abstract class BaseRepository
{
    /**
     * Model.
     *
     * @var Model
     */
    protected $model;

    /**
     * Persist model in database.
     *
     * @var bool
     */
    protected $persist = true;

    /**
     * Refresh model after insert or update.
     *
     * @var bool
     */
    protected $refresh = false;

    /**
     * Repository constructor.
     *
     * @param $model
     *
     * @throws RepositoryException
     */
    public function __construct($model)
    {
        if (!($model instanceof Model)) {
            throw new RepositoryException('Given object is not an Instance of '.Model::class);
        }

        $this->model = $model;
    }

    /**
     * @param $model
     *
     * @throws RepositoryException
     *
     * @return static
     */
    public static function init($model = null)
    {
        return new static($model);
    }

    /**
     * @param array $fields
     *
     * @throws RepositoryException
     *
     * @return Model
     */
    public function update($fields)
    {
        if (!$this->model->exists) {
            throw new RepositoryException('Instance should not be fresh for update');
        }

        return $this->save($fields);
    }

    /**
     * @param array $fields
     *
     * @return Model
     */
    protected function save($fields)
    {
        $original_fields = $fields;
        $fields = $this->beforeSave($fields);

        foreach ($fields as $field => $value) {
            $this->model->{$field} = $value;
        }
        if ($this->persist) {
            $this->model->save();
            if ($this->refresh) {
                $this->model->refresh();
            }
        }

        return $this->afterSave($original_fields, $fields);
    }

    /**
     * @param bool $permanent
     *
     * @throws RepositoryException
     *
     * @return bool|null
     */
    public function destroy($permanent = false)
    {
        if (!$this->model->exists) {
            throw new RepositoryException('Model doesn\'t exist');
        }

        $isSoftDeletable = method_exists($this->model, 'getDeletedAtColumn');

        $this->model = $this->beforeDestroy($isSoftDeletable, $permanent);

        // check if model is soft deletable
        if ($isSoftDeletable) {
            if ($permanent) {
                return $this->model->forceDelete();
            }
        }

        return $this->model->delete();
    }

    /**
     * @param bool $persist
     *
     * @return $this
     */
    public function persist($persist)
    {
        $this->persist = $persist;

        return $this;
    }

    /**
     * @param bool $refresh
     *
     * @return $this
     */
    public function refresh($refresh)
    {
        $this->refresh = $refresh;

        return $this;
    }

    /**
     * @param array|callable $rows
     *
     * @throws RepositoryException
     *
     * @return array
     */
    public function createMany($rows)
    {
        if (is_callable($rows)) {
            $rows = $rows();
        }
        $saved = [];
        foreach ($rows as $fields) {
            $saved[] = static::init()
                ->create($fields);
        }

        return $saved;
    }

    /**
     * @param array $fields
     *
     * @throws RepositoryException
     *
     * @return Model
     */
    public function create($fields)
    {
        if ($this->model->exists) {
            throw new RepositoryException('Fresh instance required for creation');
        }

        return $this->save($fields);
    }

    /**
     * @param array $fields
     *
     * @return array
     */
    protected function beforeSave($fields)
    {
        return $fields;
    }

    /**
     * @param array $original_fields
     * @param array $fields
     *
     * @return Model
     */
    protected function afterSave($original_fields, $fields)
    {
        return $this->model;
    }

    /**
     * @param bool $isSoftDeletable
     * @param bool $permanent
     *
     * @return Model
     */
    protected function beforeDestroy($isSoftDeletable, $permanent)
    {
        return $this->model;
    }

    /**
     * @throws RepositoryException
     *
     * @return Model
     */
    public function restore()
    {
        if (!$this->model->exists) {
            throw new RepositoryException('Instance should not be fresh for restoring');
        }
        if (!method_exists($this->model, 'getDeletedAtColumn')) {
            throw new RepositoryException('Model is not soft deletable');
        }
        if (!array_key_exists($this->model->getDeletedAtColumn(), $this->model->attributesToArray())) {
            throw new RepositoryException('Deleted at column doesn\'t exists on this instance');
        }
        $this->model->restore();

        return $this->afterRestore();
    }

    /**
     * @return Model
     */
    protected function afterRestore()
    {
        return $this->model;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->model->newQuery();
    }
}
