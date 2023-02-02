<?php


namespace App\Traits\Models;


use Illuminate\Support\Str;

trait HasSlug
{

    protected static function bootHasSlug()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->unique_slug($model);
            }
        });
    }

    public static function slugFrom(): string
    {
        return 'title';
    }

    /**
     * @param $model
     * @return string
     */
    public static function unique_slug($model): string
    {
        $slug = str($model->{self::slugFrom()})->slug();
        $models = get_class($model)::query()->where('slug', 'like', '%' . $slug . '%')->get(['slug']);
        $counter[] = 0;
        foreach ($models as $item) {
            $end = Str::afterLast($item->slug, '-');
            if (is_numeric($end)) {
                $counter[] = (int)$end;
            }
        }
        $end = max($counter) == 0 ? 1 : max($counter) + 1;
        return $slug->append('-' . $end);
    }
}
