<template>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="emit('onCancellation')">
      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="min-h-screen px-4 text-center">
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <DialogOverlay class="fixed inset-0 bg-black bg-opacity-50" />
          </TransitionChild>

          <span class="inline-block h-screen align-middle" aria-hidden="true"> &#8203; </span>

          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <div
              class="my-8 inline-block w-full max-w-md transform overflow-hidden rounded-lg bg-white p-6 text-left align-middle shadow-xl transition-all"
            >
              <DialogTitle as="h3" class="mb-4 text-2xl font-medium leading-6 text-gray-900"> {{ title }} </DialogTitle>

              <DialogDescription as="p" class="mb-8 text-gray-600">
                {{ subtitle }}
              </DialogDescription>

              <button
                type="button"
                class="float-left inline-flex justify-center rounded-md border border-transparent bg-gray-100 px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2"
                @click="emit('onCancellation')"
              >
                Cancel
              </button>

              <button
                type="button"
                @click="emit('onConfirmation')"
                class="float-right inline-flex justify-center rounded-md border border-transparent bg-red-100 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2"
              >
                Confirm
              </button>
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogOverlay,
  DialogTitle,
  DialogDescription,
} from "@headlessui/vue";

defineProps({
  title: {
    type: String,
    default: "Are you sure?",
  },
  subtitle: {
    type: String,
    default: "",
  },
  isOpen: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["onConfirmation", "onCancellation"]);
</script>
