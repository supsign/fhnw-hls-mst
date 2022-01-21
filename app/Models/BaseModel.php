<?php

namespace App\Models;

use App\Helpers\Support\GeneralHelper;
use App\Services\Base\BaseModelService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

/**
 * @mixin IdeHelperBaseModel
 */
class BaseModel extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['janis_id'];

    public function newCollection(array $models = [])
    {
        return new BaseCollection($models);
    }

    public function getService(): ?BaseModelService
    {
        $className = GeneralHelper::getModelClassShortName($this);
        $serviceName = $className.'Service';

        if (!file_exists(dirname(__DIR__).'/Services/'.$className.'/'.$serviceName.'.php')) {
            return null;
        }

        $fullyQualifiedServiceName = 'App\Services\\'.$className.'\\'.$serviceName;

        if (!class_exists($fullyQualifiedServiceName)) {
            return null;
        }

        return App::make($fullyQualifiedServiceName);
    }
}
