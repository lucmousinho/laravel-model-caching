<?php namespace GeneaLabs\LaravelModelCaching;

use GeneaLabs\LaravelModelCaching\CachedBuilder as Builder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Cache\CacheManager;
use Illuminate\Cache\TaggableStore;
use Illuminate\Cache\TaggedCache;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use LogicException;

abstract class CachedModel extends Model
{
    use Cachable;

    protected $cacheTime = 60;
    protected $disableFlushOnCreate = false;
    protected $disableFlushOnDelete = false;
    protected $disableFlushOnSave = false;
    protected $disableFlushOnUpdate = false;

    public function newEloquentBuilder($query)
    {
        if (session('genealabs-laravel-model-caching-is-disabled')) {
            session()->forget('genealabs-laravel-model-caching-is-disabled');

            return new EloquentBuilder($query);
        }

        return new Builder($query, $this->cacheTime);
    }

    public static function boot()
    {
        parent::boot();

        $class = get_called_class();
        $instance = new $class;

        static::created(function () use ($instance) {
            if (!$instance->disableFlushOnCreate) {
                $instance->flushCache();
            }
        });

        static::deleted(function () use ($instance) {
            if (!$instance->disableFlushOnDelete) {
                $instance->flushCache();
            }
        });

        static::saved(function () use ($instance) {
            if (!$instance->disableFlushOnSave) {
                $instance->flushCache();
            }
        });

        static::updated(function () use ($instance) {
            if (!$instance->disableFlushOnUpdate) {
                $instance->flushCache();
            }
        });
    }

    public static function all($columns = ['*'])
    {
        $class = get_called_class();
        $instance = new $class;
        $tags = [str_slug(get_called_class())];
        $key = $instance->makeCacheKey();

        return $instance->cache($tags)
            ->remember($key, $instance->cacheTime, function () use ($columns) {
                return parent::all($columns);
            });
    }
}
