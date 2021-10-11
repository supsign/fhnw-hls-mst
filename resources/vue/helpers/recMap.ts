// durchläuft item rekursiv und wendet stringMap auf alle strings an.
// Caution: manipulates item
export function recMap(
    item: any,
    stringMap: (key: string, value: string) => any
): void {
    if (Array.isArray(item)) {
        for (const arrayItem of item) {
            recMap(arrayItem, stringMap);
        }
        return;
    }

    if (typeof item === "object" && item !== null) {
        for (const [key, value] of Object.entries(item)) {
            if (Array.isArray(value)) {
                for (const arrayItem of value) {
                    recMap(arrayItem, stringMap);
                }
                continue;
            }

            if (typeof value === "object" && value !== null) {
                recMap(value, stringMap);
                continue;
            }

            if (typeof value === "string") {
                item[key] = stringMap(key, value);
            }
        }
    }
}
