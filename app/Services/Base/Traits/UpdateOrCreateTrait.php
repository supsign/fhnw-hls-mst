<?php

namespace App\Services\Base\Traits;

use App\Models\BaseModel;

trait UpdateOrCreateTrait 
{
	public function updateOrCreate(array $referenceAttributes, array $otherAttributes): BaseModel
	{
		$referenceAttributes = $this->sanitiseAttributes($referenceAttributes, true);
		$otherAttributes = $this->sanitiseAttributes($otherAttributes);

		foreach (array_keys(array_intersect($referenceAttributes, $otherAttributes)) AS $duplicateKey) {
			unset($otherAttributes[$duplicateKey]);
		}

		return $this->model::updateOrCreate(
			$referenceAttributes,
			$otherAttributes,
		);
	}
}