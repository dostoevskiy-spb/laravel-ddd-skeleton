<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Assign\CombinedAssignRector;
use Rector\CodeQuality\Rector\BooleanAnd\SimplifyEmptyArrayCheckRector;
use Rector\CodeQuality\Rector\BooleanNot\SimplifyDeMorganBinaryRector;
use Rector\CodeQuality\Rector\Foreach_\ForeachToInArrayRector;
use Rector\CodeQuality\Rector\Foreach_\SimplifyForeachToArrayFilterRector;
use Rector\CodeQuality\Rector\Foreach_\SimplifyForeachToCoalescingRector;
use Rector\CodeQuality\Rector\FuncCall\InArrayAndArrayKeysToArrayKeyExistsRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyFuncGetArgsCountRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyInArrayValuesRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyStrposLowerRector;
use Rector\CodeQuality\Rector\FuncCall\SingleInArrayToCompareRector;
use Rector\CodeQuality\Rector\Identical\GetClassToInstanceOfRector;
use Rector\CodeQuality\Rector\Identical\SimplifyArraySearchRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfNotNullReturnRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector;
use Rector\CodeQuality\Rector\Return_\SimplifyUselessVariableRector;
use Rector\CodeQuality\Rector\Ternary\SimplifyTautologyTernaryRector;
use Rector\CodeQuality\Rector\Ternary\UnnecessaryTernaryExpressionRector;
use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\DeadCode\Rector\Array_\RemoveDuplicatedArrayKeyRector;
use Rector\DeadCode\Rector\Assign\RemoveAssignOfVoidReturnFunctionRector;
use Rector\DeadCode\Rector\Assign\RemoveDoubleAssignRector;
use Rector\DeadCode\Rector\Assign\RemoveUnusedVariableAssignRector;
use Rector\DeadCode\Rector\BinaryOp\RemoveDuplicatedInstanceOfRector;
use Rector\DeadCode\Rector\BooleanAnd\RemoveAndTrueRector;
use Rector\DeadCode\Rector\Cast\RecastingRemovalRector;
use Rector\DeadCode\Rector\ClassConst\RemoveUnusedPrivateClassConstantRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveDeadConstructorRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveDelegatingParentCallRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedConstructorParamRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodParameterRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\DeadCode\Rector\Concat\RemoveConcatAutocastRector;
use Rector\DeadCode\Rector\Expression\RemoveDeadStmtRector;
use Rector\DeadCode\Rector\Expression\SimplifyMirrorAssignRector;
use Rector\DeadCode\Rector\For_\RemoveDeadIfForeachForRector;
use Rector\DeadCode\Rector\For_\RemoveDeadLoopRector;
use Rector\DeadCode\Rector\Foreach_\RemoveUnusedForeachKeyRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveCodeAfterReturnRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveDeadReturnRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveDuplicatedIfReturnRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveOverriddenValuesRector;
use Rector\DeadCode\Rector\If_\RemoveDeadInstanceOfRector;
use Rector\DeadCode\Rector\If_\RemoveUnusedNonEmptyArrayBeforeForeachRector;
use Rector\DeadCode\Rector\If_\SimplifyIfElseWithSameContentRector;
use Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfFunctionExistsRector;
use Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfPhpVersionRector;
use Rector\DeadCode\Rector\MethodCall\RemoveEmptyMethodCallRector;
use Rector\DeadCode\Rector\Node\RemoveNonExistingVarAnnotationRector;
use Rector\DeadCode\Rector\Property\RemoveSetterOnlyPropertyAndMethodCallRector;
use Rector\DeadCode\Rector\Property\RemoveUnusedPrivatePropertyRector;
use Rector\DeadCode\Rector\PropertyProperty\RemoveNullPropertyInitializationRector;
use Rector\DeadCode\Rector\Return_\RemoveDeadConditionAboveReturnRector;
use Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector;
use Rector\DeadCode\Rector\Switch_\RemoveDuplicatedCaseInSwitchRector;
use Rector\DeadCode\Rector\Ternary\TernaryToBooleanOrFalseToBooleanAndRector;
use Rector\DeadCode\Rector\TryCatch\RemoveDeadTryCatchRector;
use Rector\Laravel\Set\LaravelSetList;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\PHPUnit\Rector\ClassMethod\RemoveEmptyTestMethodRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator;
use Rector\CodeQuality\Rector\Array_\ArrayThisCallToThisMethodCallRector;
use Rector\CodeQuality\Rector\Array_\CallableThisArrayToAnonymousFunctionRector;
use Rector\CodeQuality\Rector\Assign\SplitListAssignToSeparateLineRector;
use Rector\CodeQuality\Rector\Catch_\ThrowWithPreviousExceptionRector;
use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\CodeQuality\Rector\ClassMethod\DateTimeToDateTimeInterfaceRector;
use Rector\CodeQuality\Rector\ClassMethod\NarrowUnionTypeDocRector;
use Rector\CodeQuality\Rector\Concat\JoinStringConcatRector;
use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;
use Rector\CodeQuality\Rector\Expression\InlineIfToExplicitIfRector;
use Rector\CodeQuality\Rector\For_\ForRepeatedCountToOwnVariableRector;
use Rector\CodeQuality\Rector\For_\ForToForeachRector;
use Rector\CodeQuality\Rector\Foreach_\ForeachItemsAssignToEmptyArrayToAssignRector;
use Rector\CodeQuality\Rector\Foreach_\UnusedForeachValueToArrayKeysRector;
use Rector\CodeQuality\Rector\FuncCall\AddPregQuoteDelimiterRector;
use Rector\CodeQuality\Rector\FuncCall\ArrayKeysAndInArrayToArrayKeyExistsRector;
use Rector\CodeQuality\Rector\FuncCall\ArrayMergeOfNonArraysToSimpleArrayRector;
use Rector\CodeQuality\Rector\FuncCall\CallUserFuncWithArrowFunctionToInlineRector;
use Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector;
use Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector;
use Rector\CodeQuality\Rector\FuncCall\IntvalToTypeCastRector;
use Rector\CodeQuality\Rector\FuncCall\IsAWithStringWithThirdArgumentRector;
use Rector\CodeQuality\Rector\FuncCall\RemoveSoleValueSprintfRector;
use Rector\CodeQuality\Rector\FuncCall\SetTypeToCastRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyRegexPatternRector;
use Rector\CodeQuality\Rector\FuncCall\UnwrapSprintfOneArgumentRector;
use Rector\CodeQuality\Rector\FunctionLike\RemoveAlwaysTrueConditionSetInConstructorRector;
use Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector;
use Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector;
use Rector\CodeQuality\Rector\Identical\StrlenZeroToIdenticalEmptyStringRector;
use Rector\CodeQuality\Rector\If_\CombineIfRector;
use Rector\CodeQuality\Rector\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodeQuality\Rector\If_\ShortenElseIfRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfElseToTernaryRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfIssetToNullCoalescingRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfNullableReturnRector;
use Rector\CodeQuality\Rector\Include_\AbsolutizeRequireAndIncludePathRector;
use Rector\CodeQuality\Rector\Isset_\IssetOnPropertyObjectToPropertyExistsRector;
use Rector\CodeQuality\Rector\LogicalAnd\AndAssignsToSeparateLinesRector;
use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\CodeQuality\Rector\Name\FixClassCaseSensitivityNameRector;
use Rector\CodeQuality\Rector\New_\NewStaticToNewSelfRector;
use Rector\CodeQuality\Rector\NotEqual\CommonNotEqualRector;
use Rector\CodeQuality\Rector\Switch_\SingularSwitchToIfRector;
use Rector\CodeQuality\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector;
use Rector\CodeQuality\Rector\Ternary\SimplifyDuplicatedTernaryRector;
use Rector\CodeQuality\Rector\Ternary\SwitchNegatedTernaryRector;
use Rector\CodingStyle\Rector\ClassMethod\FuncGetArgsToVariadicParamRector;
use Rector\CodingStyle\Rector\FuncCall\CallUserFuncToMethodCallRector;
use Rector\Php52\Rector\Property\VarToPublicPropertyRector;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;

$configurator = new RectorConfigurator();

return static function (ContainerConfigurator $containerConfigurator) use ($configurator): void {
    $containerConfigurator->import(LaravelSetList::LARAVEL_60);
    $configurator->setCodeQualityParams($containerConfigurator->services());
    $configurator->setDeadCodeParams($containerConfigurator->services());
    // get parameters
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/app/Common',
        __DIR__ . '/app/Core',
        __DIR__ . '/app/Components',
        __DIR__ . '/app/config',
        __DIR__ . '/app/Providers',
        __DIR__ . '/app/Models',
    ]);
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_80);
    $parameters->set(Option::ENABLE_CACHE, true);
//    $parameters->set(Option::PHPSTAN_FOR_RECTOR_PATH, getcwd() . '/phpstan-for-config.neon');


    // get services (needed for register a single rule)
    // $services = $containerConfigurator->services();

    // register a single rule
    // $services->set(TypedPropertyRector::class);
};


class RectorConfigurator {

    public function setDeadCodeParams(ServicesConfigurator $services): void
    {
        $services->set(UnwrapFutureCompatibleIfFunctionExistsRector::class);
        $services->set(UnwrapFutureCompatibleIfPhpVersionRector::class);
        $services->set(RecastingRemovalRector::class);
        $services->set(RemoveDeadStmtRector::class);
        $services->set(RemoveDuplicatedArrayKeyRector::class);
        $services->set(RemoveUnusedForeachKeyRector::class);
        $services->set(RemoveParentCallWithoutParentRector::class);
        $services->set(RemoveEmptyClassMethodRector::class);
        $services->set(RemoveDoubleAssignRector::class);
        $services->set(SimplifyMirrorAssignRector::class);
        $services->set(RemoveOverriddenValuesRector::class);
        $services->set(RemoveUnusedPrivatePropertyRector::class);
        $services->set(RemoveUnusedPrivateClassConstantRector::class);
        $services->set(RemoveUnusedPrivateMethodRector::class);
        $services->set(RemoveCodeAfterReturnRector::class);
        $services->set(RemoveDeadConstructorRector::class);
        $services->set(RemoveDeadReturnRector::class);
        $services->set(RemoveDeadIfForeachForRector::class);
        $services->set(RemoveAndTrueRector::class);
        $services->set(RemoveConcatAutocastRector::class);
        $services->set(SimplifyUselessVariableRector::class);
        $services->set(RemoveDelegatingParentCallRector::class);
        $services->set(RemoveDuplicatedInstanceOfRector::class);
        $services->set(RemoveDuplicatedCaseInSwitchRector::class);
        $services->set(RemoveSetterOnlyPropertyAndMethodCallRector::class);
        $services->set(RemoveNullPropertyInitializationRector::class);
        $services->set(SimplifyIfElseWithSameContentRector::class);
        $services->set(TernaryToBooleanOrFalseToBooleanAndRector::class);
        $services->set(RemoveEmptyTestMethodRector::class);
        $services->set(RemoveDeadTryCatchRector::class);
        $services->set(RemoveUnusedVariableAssignRector::class);
        $services->set(RemoveDuplicatedIfReturnRector::class);
        $services->set(RemoveUnusedNonEmptyArrayBeforeForeachRector::class);
        $services->set(RemoveAssignOfVoidReturnFunctionRector::class);
        $services->set(RemoveEmptyMethodCallRector::class);
        $services->set(RemoveDeadConditionAboveReturnRector::class);
        $services->set(RemoveUnusedConstructorParamRector::class);
        $services->set(RemoveDeadInstanceOfRector::class);
        $services->set(RemoveDeadLoopRector::class);
        $services->set(RemoveUnusedPrivateMethodParameterRector::class);

        // docblock
        $services->set(RemoveUselessParamTagRector::class);
        $services->set(RemoveUselessReturnTagRector::class);
        $services->set(RemoveNonExistingVarAnnotationRector::class);
    }

    public function setCodeQualityParams(ServicesConfigurator $services)
    {
        $services->set(CombinedAssignRector::class);
        $services->set(SimplifyEmptyArrayCheckRector::class);
        $services->set(ForeachToInArrayRector::class);
        $services->set(SimplifyForeachToCoalescingRector::class);
        $services->set(InArrayAndArrayKeysToArrayKeyExistsRector::class);
        $services->set(SimplifyFuncGetArgsCountRector::class);
        $services->set(SimplifyInArrayValuesRector::class);
        $services->set(SimplifyStrposLowerRector::class);
        $services->set(GetClassToInstanceOfRector::class);
        $services->set(SimplifyArraySearchRector::class);
        $services->set(SimplifyIfNotNullReturnRector::class);
        $services->set(SimplifyIfReturnBoolRector::class);
        $services->set(SimplifyUselessVariableRector::class);
        $services->set(UnnecessaryTernaryExpressionRector::class);
        $services->set(RemoveExtraParametersRector::class);
        $services->set(SimplifyDeMorganBinaryRector::class);
        $services->set(SimplifyTautologyTernaryRector::class);
        $services->set(SimplifyForeachToArrayFilterRector::class);
        $services->set(SingleInArrayToCompareRector::class);
        $services->set(SimplifyIfElseToTernaryRector::class);
        $services->set(JoinStringConcatRector::class);
        $services->set(ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class);
        $services->set(SimplifyIfIssetToNullCoalescingRector::class);
        $services->set(ExplicitBoolCompareRector::class);
        $services->set(CombineIfRector::class);
        $services->set(UseIdenticalOverEqualWithSameTypeRector::class);
        $services->set(SimplifyDuplicatedTernaryRector::class);
        $services->set(SimplifyBoolIdenticalTrueRector::class);
        $services->set(SimplifyRegexPatternRector::class);
        $services->set(BooleanNotIdenticalToNotIdenticalRector::class);
        $services->set(CallableThisArrayToAnonymousFunctionRector::class);
        $services->set(AndAssignsToSeparateLinesRector::class);
        $services->set(ForToForeachRector::class);
        $services->set(CompactToVariablesRector::class);
        $services->set(CompleteDynamicPropertiesRector::class);
        $services->set(IsAWithStringWithThirdArgumentRector::class);
        $services->set(StrlenZeroToIdenticalEmptyStringRector::class);
        $services->set(RemoveAlwaysTrueConditionSetInConstructorRector::class);
        $services->set(ThrowWithPreviousExceptionRector::class);
        $services->set(RemoveSoleValueSprintfRector::class);
        $services->set(ShortenElseIfRector::class);
        $services->set(AddPregQuoteDelimiterRector::class);
        $services->set(ArrayMergeOfNonArraysToSimpleArrayRector::class);
        $services->set(IntvalToTypeCastRector::class);
        $services->set(ArrayKeyExistsTernaryThenValueToCoalescingRector::class);
        $services->set(AbsolutizeRequireAndIncludePathRector::class);
        $services->set(ChangeArrayPushToArrayAssignRector::class);
        $services->set(ForRepeatedCountToOwnVariableRector::class);
        $services->set(ForeachItemsAssignToEmptyArrayToAssignRector::class);
        $services->set(InlineIfToExplicitIfRector::class);
        $services->set(ArrayKeysAndInArrayToArrayKeyExistsRector::class);
        $services->set(SplitListAssignToSeparateLineRector::class);
        $services->set(UnusedForeachValueToArrayKeysRector::class);
        $services->set(ArrayThisCallToThisMethodCallRector::class);
        $services->set(CommonNotEqualRector::class);
        $services->set(RenameFunctionRector::class)
            ->call('configure', [[
                                     RenameFunctionRector::OLD_FUNCTION_TO_NEW_FUNCTION => [
                                         'split' => 'explode',
                                         'join' => 'implode',
                                         'sizeof' => 'count',
                                         # https://www.php.net/manual/en/aliases.php
                                         'chop' => 'rtrim',
                                         'doubleval' => 'floatval',
                                         'gzputs' => 'gzwrites',
                                         'fputs' => 'fwrite',
                                         'ini_alter' => 'ini_set',
                                         'is_double' => 'is_float',
                                         'is_integer' => 'is_int',
                                         'is_long' => 'is_int',
                                         'is_real' => 'is_float',
                                         'is_writeable' => 'is_writable',
                                         'key_exists' => 'array_key_exists',
                                         'pos' => 'current',
                                         'strchr' => 'strstr',
                                         # mb
                                         'mbstrcut' => 'mb_strcut',
                                         'mbstrlen' => 'mb_strlen',
                                         'mbstrpos' => 'mb_strpos',
                                         'mbstrrpos' => 'mb_strrpos',
                                         'mbsubstr' => 'mb_substr',
                                     ],
                                 ]]);
        $services->set(SetTypeToCastRector::class);
        $services->set(LogicalToBooleanRector::class);
        $services->set(VarToPublicPropertyRector::class);
        $services->set(FixClassCaseSensitivityNameRector::class);
        $services->set(IssetOnPropertyObjectToPropertyExistsRector::class);
        $services->set(NewStaticToNewSelfRector::class);
        $services->set(DateTimeToDateTimeInterfaceRector::class);
        $services->set(UnwrapSprintfOneArgumentRector::class);
        $services->set(SwitchNegatedTernaryRector::class);
        $services->set(SingularSwitchToIfRector::class);
        $services->set(SimplifyIfNullableReturnRector::class);
        $services->set(NarrowUnionTypeDocRector::class);
        $services->set(FuncGetArgsToVariadicParamRector::class);
        $services->set(CallUserFuncToMethodCallRector::class);
        $services->set(CallUserFuncWithArrowFunctionToInlineRector::class);
    }
}
