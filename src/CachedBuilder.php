<?php namespace GeneaLabs\LaravelModelCaching;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class CachedBuilder extends EloquentBuilder
{
    use Cachable;

    public function __construct($query, $cacheTime)
    {
        $this->cacheTime = $cacheTime;
        parent::__construct($query);
    }

    public function avg($column)
    {
        if (! $this->isCachable) {
            return parent::avg($column);
        }

        return $this->cache($this->makeCacheTags())
            ->remember(
                $this->makeCacheKey(['*'], null, "-avg_{$column}"),
                $this->cacheTime,
                function () use ($column) {
                    return parent::avg($column);
                }
            );
    }

    public function count($columns = ['*'])
    {
        if (! $this->isCachable) {
            return parent::count($columns);
        }

        return $this->cache($this->makeCacheTags())
            ->remember(
                $this->makeCacheKey(['*'], null, "-count"),
                $this->cacheTime,
                function () use ($columns) {
                    return parent::count($columns);
                }
            );
    }

    public function cursor()
    {
        if (! $this->isCachable) {
            return collect(parent::cursor());
        }

        return $this->cache($this->makeCacheTags())
            ->remember(
                $this->makeCacheKey(['*'], null, "-cursor"),
                $this->cacheTime,
                function () {
                    return collect(parent::cursor());
                }
            );
    }

    public function delete()
    {
        $this->cache($this->makeCacheTags())
            ->flush();

        return parent::delete();
    }

    /**
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function find($id, $columns = ['*'])
    {
        if (! $this->isCachable) {
            return parent::find($id, $columns);
        }

        return $this->cache($this->makeCacheTags())
            ->remember(
                $this->makeCacheKey($columns, $id),
                $this->cacheTime,
                function () use ($id, $columns) {
                    return parent::find($id, $columns);
                }
            );
    }

    public function first($columns = ['*'])
    {
        if (! $this->isCachable) {
            return parent::first($columns);
        }

        return $this->cache($this->makeCacheTags())
            ->remember(
                $this->makeCacheKey($columns, null, '-first'),
                $this->cacheTime,
                function () use ($columns) {
                    return parent::first($columns);
                }
            );
    }

    public function get($columns = ['*'])
    {
        if (! $this->isCachable) {
            return parent::get($columns);
        }

        return $this->cache($this->makeCacheTags())
            ->remember(
                $this->makeCacheKey($columns),
                $this->cacheTime,
                function () use ($columns) {
                    return parent::get($columns);
                }
            );
    }

    public function max($column)
    {
        if (! $this->isCachable) {
            return parent::max($column);
        }

        return $this->cache($this->makeCacheTags())
            ->remember(
                $this->makeCacheKey(['*'], null, "-max_{$column}"),
                $this->cacheTime,
                function () use ($column) {
                    return parent::max($column);
                }
            );
    }

    public function min($column)
    {
        if (! $this->isCachable) {
            return parent::min($column);
        }

        return $this->cache($this->makeCacheTags())
            ->remember(
                $this->makeCacheKey(['*'], null, "-min_{$column}"),
                $this->cacheTime,
                function () use ($column) {
                    return parent::min($column);
                }
            );
    }

    public function pluck($column, $key = null)
    {
        if (! $this->isCachable) {
            return parent::pluck($column, $key);
        }

        $keyDifferentiator = "-pluck_{$column}" . ($key ? "_{$key}" : "");
        $cacheKey = $this->makeCacheKey([$column], null, $keyDifferentiator);

        return $this->cache($this->makeCacheTags())
            ->remember($cacheKey, $this->cacheTime, function () use ($column, $key) {
                return parent::pluck($column, $key);
            });
    }

    public function sum($column)
    {
        if (! $this->isCachable) {
            return parent::sum($column);
        }

        return $this->cache($this->makeCacheTags())
            ->remember(
                $this->makeCacheKey(['*'], null, "-sum_{$column}"),
                $this->cacheTime,
                function () use ($column) {
                    return parent::sum($column);
                }
            );
    }

    public function value($column)
    {
        if (! $this->isCachable) {
            return parent::value($column);
        }

        return $this->cache($this->makeCacheTags())
            ->remember(
                $this->makeCacheKey(['*'], null, "-value_{$column}"),
                $this->cacheTime,
                function () use ($column) {
                    return parent::value($column);
                }
            );
    }
}
