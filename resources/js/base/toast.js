import toasteventbus from 'primevue/toasteventbus'

export function info(summary, detail = null, life = 5000) {
    toasteventbus.emit('add', { severity: 'info', summary, detail, life })
}

export function warn(summary, detail = null, life = 5000) {
    toasteventbus.emit('add', { severity: 'warn', summary, detail, life })
}

export function success(summary, detail = null, life = 5000) {
    toasteventbus.emit('add', { severity: 'success', summary, detail, life })
}

export function error(summary, detail = null, life = 5000) {
    toasteventbus.emit('add', { severity: 'error', summary, detail, life })
}
