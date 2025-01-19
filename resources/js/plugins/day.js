import * as dayjs from 'dayjs'
import 'dayjs/locale/ru'

export const changeDayjsLocale = function (locale) {
    dayjs.locale(locale)
}

dayjs.locale('ru');
export default dayjs
