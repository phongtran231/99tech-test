<?php

namespace Modules\Products\Http\Requests;

class ProductUpdateRequest extends ProductStoreRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['images'] = [
            'array',
            'max:5',
            function ($attribute, $value, $fail) {
                $uploadedImages = $this->request->get('uploaded_images');

                if (isset($uploadedImages) && is_array($uploadedImages)) {
                    $summaryImages = count($value) + count($uploadedImages);

                    if ($summaryImages > 5) {
                        return $fail('maximum ' . $attribute . ' can be upload is 5.');
                    }
                }
                return true;
            },
        ];
        return $rules;
    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        return $url->route('product.edit', ['product' => $this->route('product')]);
    }
}
