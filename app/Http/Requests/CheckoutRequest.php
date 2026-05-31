<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            // For single product checkout (from the current view)
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];

        if ($this->product_id) {
            $product = Product::with('fields')->find($this->product_id);
            if ($product) {
                foreach ($product->fields as $field) {
                    $key = "field_{$field->id}";
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

        return $rules;
    }
    
    public function messages(): array
    {
        return [
            'payment_proof.required' => 'Bukti pembayaran wajib diunggah.',
            'payment_proof.image' => 'Bukti pembayaran harus berupa gambar.',
            'payment_proof.mimes' => 'Format gambar harus JPEG, PNG, atau JPG.',
            'payment_proof.max' => 'Ukuran gambar maksimal 5MB.',
            'field_*.required' => 'Field ini wajib diisi.',
            'field_*.image' => 'File harus berupa gambar.',
            'field_*.mimes' => 'Format gambar harus JPEG, PNG, atau JPG.',
            'field_*.max' => 'Ukuran gambar maksimal 5MB.',
        ];
    }
}
