/*
import { TransLation } from "../../translation";
import * as EmailValidator from "email-validator";
import { ICreateValidationRuleOption } from "../../../store/createValidationRuleOption.interface";

export class ValidationRule {
    private errorString = "l.error";

    protected constructor(
        rule: (value: string) => boolean,
        errorString: string
    ) {
        this.rule = rule;
        this.errorString = errorString;
    }

    static get required() {
        const rule = (value: any): boolean => {
            if (Array.isArray(value)) {
                return !!value.length;
            }

            if (value === undefined || value === null) {
                return false;
            }

            if (value === false) {
                return false;
            }

            if (value instanceof Date) {
                // invalid date won't pass
                return !isNaN(value.getTime());
            }

            if (typeof value === "object") {
                for (const _ in value) {
                    return true;
                }
                return false;
            }

            return !!String(value).length;
        };

        const errorString = TransLation.get("validation.below.required");

        return new ValidationRule(rule, errorString);
    }

    static email(): ValidationRule {
        const rule = (value: any): boolean => {
            return EmailValidator.validate(value);
        };

        const errorString = TransLation.get("validation.below.email");

        return new ValidationRule(rule, errorString);
    }

    static minLength(minLength: number): ValidationRule {
        const rule = (value: any): boolean => {
            return (
                String(value).length >= minLength || String(value).length === 0
            );
        };

        const errorString = TransLation.get("validation.below.min.string", {
            min: minLength.toString()
        });

        return new ValidationRule(rule, errorString);
    }

    static maxLength(maxLength: number): ValidationRule {
        const rule = (value: any): boolean => {
            return String(value).length <= maxLength;
        };

        const errorString = TransLation.get("validation.below.max.string", {
            max: maxLength.toString()
        });

        return new ValidationRule(rule, errorString);
    }

    static create(createValidationRuleOption: ICreateValidationRuleOption) {
        switch (createValidationRuleOption.name) {
            case "min":
                let minLength = createValidationRuleOption.paramters?.[0];

                if (typeof minLength === "string") {
                    minLength = parseInt(minLength, 10);
                }

                if (!minLength || typeof minLength !== "number") {
                    minLength = 1;
                }
                return ValidationRule.minLength(minLength);

            case "max":
                let maxLength = createValidationRuleOption.paramters?.[0];

                if (typeof maxLength === "string") {
                    maxLength = parseInt(maxLength, 10);
                }

                if (!maxLength || typeof maxLength !== "number") {
                    maxLength = 1;
                }
                return ValidationRule.maxLength(maxLength);

            case "email":
                return ValidationRule.email();

            default:
                break;
        }
    }

    public validate(value: any): { isValid: boolean; error?: string } {
        const isValid = this.evaluate(value);
        return {
            isValid,
            error: !isValid ? this.errorString : undefined
        };
    }

    private rule: (value: string) => boolean = (): boolean => {
        throw new Error("must be implemented on derived class");
    };

    private evaluate(value: any): boolean {
        return this.rule(value);
    }
}
*/
