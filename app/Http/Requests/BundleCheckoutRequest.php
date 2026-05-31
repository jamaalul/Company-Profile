<?php

namespace App\Http\Requests;

use App\Models\Bundle;
use Illuminate\Foundation\Http\FormRequest;

class BundleCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'payment_method' => ['required', 'in:qris'],
            'payment_proof' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:5120' // 5MB max
            ],
            'bundle_id' => ['required', 'exists:bundles,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];

        // Add dynamic validation for bundle product fields
        if ($this->bundle_id) {
            $bundle = Bundle::with('products.fields')->find($this->bundle_id);
            if ($bundle) {
                foreach ($bundle->products as $product) {
                    for ($copy = 0; $copy < $product->pivot->quantity; $copy++) {
                        foreach ($product->fields as $field) {
                            $key = "fields.{$product->id}.{$copy}.{$field->id}";
                            $fieldRules = [];

                            if ($field->field_type === 'file') {
                                $fieldRules[] = 'image';
                                $fieldRules[] = 'mimes:jpeg,png,jpg';
                                $fieldRules[] = 'max:5120';
                            } elseif ($field->field_type === 'text') {
                                $fieldRules[] = 'string';
                                $fieldRules[] = 'max:1000';
                            } elseif ($field->field_type === 'dropdown') {
                                $fieldRules[] = 'string';
                            }

                            if ($field->is_required) {
                                array_unshift($fieldRules, 'required');
                            } else {
                                array_unshift($fieldRules, 'nullable');
                            }

                            $rules[$key] = $fieldRules;
                        }
                    }
                }
            }
        }

        return $rules;
    }
    
    public function messages(): array
    {
        return [
            'payment_proof.required' => 'Bukti pembayaran wajib diunggah.',
            'payment_proof.image' => 'Bukti pembayaran harus berupa gambar.',
            'payment_proof.mimes' => 'Format gambar harus JPEG, PNG, atau JPG.',
            'payment_proof.max' => 'Ukuran gambar maksimal 5MB.',
            'fields.*.*.*.required' => 'Field ini wajib diisi.',
        ];
    }
}

