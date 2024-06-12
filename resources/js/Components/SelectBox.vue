<template>
    <div>
        <select
            :id="id"
            :name="name"
            v-model="selectedValue"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-Dark focus:border-Dark sm:text-sm rounded-md"
            @change="updateValue"
        >
            <option
                v-for="option in options"
                :key="option.value"
                :value="option.value"
            >
                {{ option.label }}
            </option>
        </select>
    </div>
</template>

<script setup>
import { ref, defineProps, watch } from "vue";

// Define props
const props = defineProps({
    modelValue: [String, Number],
    options: {
        type: Array,
        required: true,
        default: () => [],
    },

    id: {
        type: String,
        default: "",
    },
    name: {
        type: String,
        default: "",
    },
});

// Local state for the selected value
const selectedValue = ref(props.modelValue);

// Watch for changes in props.modelValue to update the local state
watch(
    () => props.modelValue,
    (newValue) => {
        selectedValue.value = newValue;
    }
);

// Emit the updated value to the parent component
const emit = defineEmits(["update:modelValue"]);
const updateValue = () => {
    emit("update:modelValue", selectedValue.value);
};
</script>

<style scoped>
/* Tambahkan gaya CSS yang diperlukan */
</style>
