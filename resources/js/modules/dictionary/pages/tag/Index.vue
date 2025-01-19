<script setup>
import { computed, reactive, ref } from 'vue'
import { storeToRefs } from 'pinia'
import { useTagStore } from "@dictionary/pages/tag/tagStore.js";
import { useForm } from "vee-validate";
import * as yup from "yup";

const { items, meta, loading } = storeToRefs(useTagStore())
const { fetchAll, save } = useTagStore()

fetchAll();

const showForm = ref(false);


const { handleSubmit } = useForm();
const onSubmit = handleSubmit(() => {
    save({ code: item.code, name: item.name });
    showForm.value = false;
    item.code = '';
    item.name = '';
});

const item = reactive({
    code: '',
    name: ''
});
const search = ref('');

const itemCodes = computed(() => items.value.map(o => o.code));
</script>

<template>
    <div>
        <div class="flex flex-wrap gap-2 items-center justify-between mb-2">
            <h4 class="m-0">
                ТЭГИ
            </h4>
            <div class="flex">
                <ButtonZ class="mr-2" icon="pi pi-plus" label="buttons.create" severity="secondary" @click="showForm = true"/>
                <InputTextZ v-model="search" name="search" t="input.dictionary.tag.search"/>
            </div>
        </div>

        <DataTable :value="items">
            <Column field="name" header="Название" sortable></Column>
            <Column field="code" header="Код" sortable></Column>
        </DataTable>

        <Dialog v-model:visible="showForm" header="Добавить категорию" modal>
            <FormZ class="flex gap-4" @submit="onSubmit">
                <InputTextZ v-model="item.name" :rule="yup.string().required()" name="name" t="input.dictionary.tag.name"/>
                <InputTextZ v-model="item.code" :rule="yup.string().required().notOneOf(itemCodes)" name="code" t="input.dictionary.tag.code"/>

                <div class="flex justify-end gap-2">
                    <Button label="Отмена" severity="secondary" type="button" @click="showForm = false"></Button>
                    <Button label="Сохранить" type="submit"></Button>
                </div>
            </FormZ>
        </Dialog>
    </div>
</template>

<style lang="scss" scoped>

</style>
