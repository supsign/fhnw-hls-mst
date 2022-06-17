import { FieldControl } from './fieldControl';

export class FormControl {
    private fieldControls: FieldControl[] = [];

    public get isValid() {
        let isValid = true;
        for (const fieldControl of this.fieldControls) {
            if (!fieldControl.isValid) {
                isValid = false;
            }
        }

        return isValid;
    }

    public addFieldControl(fieldControl: FieldControl) {
        this.fieldControls.push(fieldControl);
    }
}
