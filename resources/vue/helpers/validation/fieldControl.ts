import { ValidationRule } from './rules/validationRule';

export class FieldControl {
    private rules: ValidationRule[] = [];
    private _value: any;

    constructor(fieldName: string, rules: ValidationRule[] = []) {
        this._isValid = true;
        this._fieldName = fieldName;
        this.rules = rules;
    }

    private _isValid: boolean;

    public get isValid() {
        return this._isValid;
    }

    private _errors: any[] = [];

    public get errors() {
        return this._errors;
    }

    private _fieldName: string;

    public get fieldName() {
        return this._fieldName;
    }

    public addValidationRule(...validationRules: ValidationRule[]) {
        this.rules.push(...validationRules);
    }

    public validate(value: any) {
        this._value = value;
        this._isValid = true;
        this._errors.length = 0;
        for (const rule of this.rules) {
            if (!this.validateRule(this._value, rule)) {
                this._isValid = false;
            }
        }

        return this._isValid;
    }

    private validateRule(value: any, rule: any) {
        const validation = rule.validate(value);
        if (!validation.isValid) {
            this._errors.push(validation.error);
            return false;
        }

        return true;
    }
}
