

export class FieldControl {
    private _isValid = true;

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
}
