<?php

namespace App\Services\Categories;

use App\Models\Category;
use App\Services\Search\SearchInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * CategorySearchService - wyszukiwanie kategorii
 * 
 * @author Piotr Knychała
 * 
 */
class CategorySearchService implements SearchInterface
{
    /**
     * Wyszukiwanie kategorii, których nazwy zawierają ciąg znakowy $value.
     * 
     * W przypadku, kiedy wyszukiwany ciąg ma wartość null lub długość zero,
     * zwracana jest $limit ilość pierwszych elementów, posortowanych 
     * alfabetycznie wg. nazwy. 
     *
     * @param string|null $value Wyszukiwany ciąg znakowy.
     * @param integer $limit Zwracana ilość elementów w przypadku, gdy $value jest równe null lub ciąg znakowy $value ma długość zero.
     * @return \Illuminate\Database\Eloquent\Collection Kolekcja kategorii.
     */
    public function search(?string $value, int $limit = 5): Collection
    {
        if ($value !== null && strlen($value) !== 0) {
            return Category::where('name', 'like', '%' . $value . '%')
                ->get(['id', 'name']);
        }
        return Category::limit($limit)
            ->get(['id', 'name']);
    }
}
