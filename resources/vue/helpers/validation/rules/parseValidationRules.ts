import { ICreateValidationRuleOption } from '../../../store/createValidationRuleOption.interface';

export function parseValidationRules(parseValidationRules: string): Array<ICreateValidationRuleOption> {
    const rules = parseValidationRules.split('|');

    if (rules.length === 0) {
        return [];
    }
    const createValidationRuleOptions: Array<ICreateValidationRuleOption> = [];

    for (const rule of rules) {
        const [name, ...parameters] = rule.split(':');
        let createValidationRuleOption: ICreateValidationRuleOption;
        if (name) {
            createValidationRuleOption = { name };
        }

        if (parameters && parameters.length > 0) {
            createValidationRuleOption.paramters = parameters;
        }

        if (createValidationRuleOption) {
            createValidationRuleOptions.push(createValidationRuleOption);
        }
    }

    return createValidationRuleOptions;
}
