<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'genre_id',
        'author',
        'ISBN',
        'language',
        'cover',
        'membership_id',
        'publisher',
        'date_of_publication',
        'path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->as('favorites')
            ->withTimestamps();
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    public function isFavotiteBook($uid)
    {
        return count($this->users()->wherePivot('user_id', $uid)->get()) == 0 ? false : true;

    }
}
