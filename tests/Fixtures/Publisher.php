<?php namespace GeneaLabs\LaravelModelCaching\Tests\Fixtures;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publisher extends Model
{
    use Cachable;

    protected $fillable = [
        'name',
    ];

    public function books() : HasMany
    {
        return $this->hasMany(Book::class);
    }
}
