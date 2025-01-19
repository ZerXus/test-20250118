const mixed = {
    "default": 'Поле является недействительным.',
    required: 'Поле должно быть заполнено',
    defined: 'Проверьте правильность заполнения',
    notNull: 'Поле не может быть нулевым',
    oneOf: 'Поле должно быть одним из следующих значений: ${values}',
    notOneOf: 'Поле не должно быть одним из следующих значений: ${values}',
    notType: function notType(_ref) {
        var path = _ref.path,
            type = _ref.type,
            value = _ref.value,
            originalValue = _ref.originalValue;
        var isCast = originalValue != null && originalValue !== value;
        var msg = path + " \u0434\u043E\u043B\u0436\u0435\u043D \u0431\u044B\u0442\u044C `" + type + "` \u0442\u0438\u043F, " + ("\u041D\u043E \u043E\u043A\u043E\u043D\u0447\u0430\u0442\u0435\u043B\u044C\u043D\u043E\u0435 \u0437\u043D\u0430\u0447\u0435\u043D\u0438\u0435 \u0431\u044B\u043B\u043E: `" + yup.printValue(value, true) + "`") + (isCast ? " (\u0431\u0440\u043E\u0441\u0438\u0442\u044C \u0438\u0437 \u0437\u043D\u0430\u0447\u0435\u043D\u0438\u044F `" + yup.printValue(originalValue, true) + "`)." : '.');

        if (value === null) {
            msg += "\n \u0415\u0441\u043B\u0438 \xAB\u043D\u0443\u043B\u044C\xBB \u043F\u0440\u0435\u0434\u043D\u0430\u0437\u043D\u0430\u0447\u0435\u043D\u043E \u043A\u0430\u043A \u043F\u0443\u0441\u0442\u043E\u0435 \u0437\u043D\u0430\u0447\u0435\u043D\u0438\u0435, \u043E\u0431\u044F\u0437\u0430\u0442\u0435\u043B\u044C\u043D\u043E \u043E\u0442\u043C\u0435\u0442\u0438\u0442\u044C \u0441\u0445\u0435\u043C\u0443 \u043A\u0430\u043A" + ' `.nullable()`';
        }

        return msg;
    },
};
const string = {
    length: 'Поле должно быть длиной ${length} символов',
    min: 'Поле должно быть длиннее ${min} символов',
    max: 'Поле должно быть равно или короче ${max} символов',
    matches: 'Поле должно соответствовать следующему: "${regex}"',
    email: 'Поле должно быть почтовым адресом',
    url: 'Поле должно быть действительный URL',
    uuid: 'Поле должно быть действительным UUID',
    trim: 'Поле должно быть обрезанной строкой',
    lowercase: 'Поле должно быть строчной строкой',
    uppercase: 'Поле должно быть строка верхнего чехла'
};
const number = {
    min: 'Поле должно быть больше или равен ${min}',
    max: 'Поле должно быть меньше или равна ${max}',
    lessThan: 'Поле должно быть меньше, чем ${less}',
    moreThan: 'Поле должно быть больше, чем ${more}',
    positive: 'Поле должно быть положительным числом',
    negative: 'Поле должно быть отрицательным числом',
    integer: 'Поле должно быть целым числом'
};
const date = {
    min: 'Поле должно быть позже ${min}',
    max: 'Поле должно быть раньше, чем ${max}'
};
const boolean = {
    isValue: 'Поле должно быть ${value}'
};
const object = {
    noUnknown: 'Поле не может иметь ключи, не указанные в форме объекта'
};
const array = {
    min: 'Поле должно иметь по крайней мере ${min} элементы',
    max: 'Поле должно иметь меньше или равное ${max} элементам',
    length: 'Поле должно иметь ${length} элементов'
};

export default {
    mixed,
    string,
    number,
    date,
    boolean,
    object,
    array,
};
