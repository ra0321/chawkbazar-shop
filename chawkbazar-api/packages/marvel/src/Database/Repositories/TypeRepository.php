<?php


namespace Marvel\Database\Repositories;

use Marvel\Database\Models\Banner;
use Marvel\Database\Models\Type;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class TypeRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'        => 'like',
    ];

    protected $dataArray = [
        'name',
        'icon',
        'promotional_sliders',
        'images',
        'settings'
    ];


    public function boot()
    {
        try {
            $this->pushCriteria(app(RequestCriteria::class));
        } catch (RepositoryException $e) {
        }
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Type::class;
    }

    public function storeType($request)
    {
        $type = $this->create($request->only($this->dataArray));
        if (isset($request['banners']) && count($request['banners'])) {
            $type->banners()->createMany($request['banners']);
        }
        $type->banners = $type->banners;
        return $type;
    }

    public function updateType($request, $type)
    {
        if (isset($request['banners'])) {
            foreach ($type->banners as $banner) {
                $key = array_search($banner->id, array_column($request['banners'], 'id'));
                if (!$key && $key !== 0) {
                    Banner::findOrFail($banner->id)->delete();
                }
            }
            foreach ($request['banners'] as $banner) {
                if (isset($banner['id'])) {
                    Banner::findOrFail($banner['id'])->update($banner);
                } else {
                    $banner['type_id'] = $type->id;
                    Banner::create($banner);
                }
            }
        }
        $type->update($request->only($this->dataArray));
        return $this->with('banners')->findOrFail($type->id);
    }
}
