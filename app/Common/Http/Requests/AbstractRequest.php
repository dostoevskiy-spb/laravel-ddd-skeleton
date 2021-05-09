<?php

declare(strict_types=1);

namespace Common\Http\Requests;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Illuminate\Validation\ValidationException;

abstract class AbstractRequest extends Request implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;

    /**
     * The container instance.
     *
     * @var Container
     */
    protected Container $container;

    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected string $errorBag = 'default';

    abstract public function authorize(): bool;

    abstract public function rules(): array;

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [];
    }

    /**
     * Set the container implementation.
     *
     * @param Container $container
     *
     * @return $this
     */
    public function setContainer(Container $container): static
    {
        $this->container = $container;
        return $this;
    }

    /**
     * Get the validator instance for the request.
     *
     * @return Validator
     * @throws BindingResolutionException
     */
    protected function getValidatorInstance(): Validator
    {
        $factory = $this->container->make(ValidationFactory::class);
        $validator = method_exists($this, 'validator')
            ? $this->container->call([$this, 'validator'], compact('factory'))
            : $this->createDefaultValidator($factory);

        if (method_exists($this, 'withValidator')) {
            $this->withValidator($validator);
        }
        return $validator;
    }

    /**
     * Create the default validator instance.
     *
     * @param ValidationFactory $factory
     *
     * @return Validator
     */
    protected function createDefaultValidator(ValidationFactory $factory): Validator
    {
        return $factory->make(
            $this->validationData(),
            $this->container->call([$this, 'rules']),
            $this->messages(),
            $this->attributes()
        );
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData(): array
    {
        return $this->all();
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     *
     * @return void
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator, $this->formatErrors($validator));
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param Validator $validator
     *
     * @return JsonResponse
     */
    protected function formatErrors(Validator $validator): JsonResponse
    {
        return new JsonResponse($validator->getMessageBag()->toArray(), 422);
    }
}
