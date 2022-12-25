<template>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="emit('closeModal')">
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
              class="my-8 inline-block w-full max-w-xl transform overflow-hidden rounded-lg bg-white p-8 text-left align-middle shadow-xl transition-all"
            >
              <DialogTitle as="h3" class="mb-8 text-2xl font-semibold leading-6 text-gray-900">
                Subscriber Details
              </DialogTitle>

              <form @submit.prevent="addSubscriber()" class="w-full">
                <!-- Email Field -->
                <div>
                  <label class="mb-2 block text-sm font-semibold text-gray-700" for="title"> Email address </label>
                  <input
                    v-model="subscriber.email"
                    type="email"
                    name="title"
                    required
                    autocomplete="off"
                    placeholder="Enter email..."
                    class="form-input mb-6 w-full rounded"
                  />
                </div>

                <!-- Name Field -->
                <div class="mb-6">
                  <label class="mb-2 block text-sm font-semibold text-gray-700" for="title"> Name </label>
                  <input
                    v-model="subscriber.name"
                    type="text"
                    name="name"
                    required
                    autocomplete="off"
                    placeholder="Enter name..."
                    class="form-input w-full rounded"
                  />
                </div>

                <!-- State Field -->
                <div class="mb-6">
                  <label class="mb-2 block text-sm font-semibold text-gray-700" for="title"> State </label>
                  <select class="form-select w-full rounded" v-model="subscriber.state">
                    <option value="active">Active</option>
                    <option value="unsubscribed">Unsubscribed</option>
                    <option value="junk">Junk</option>
                    <option value="bounced">Bounced</option>
                    <option value="unconfirmed">Unconfirmed</option>
                  </select>
                </div>

                <!-- Other Dynamic Fields -->
                <div class="grid grid-cols-2 gap-x-4">
                  <div v-for="field in subscriber.fields" :key="field.id">
                    <div v-if="field.type == 'text'" class="mb-6">
                      <label class="mb-2 block text-sm font-semibold capitalize text-gray-700" :for="field.title">
                        {{ field.title }}
                      </label>
                      <input
                        v-model="field.value"
                        type="text"
                        :name="field.title"
                        autocomplete="off"
                        :placeholder="`Enter ${field.title}...`"
                        class="form-input w-full rounded"
                      />
                    </div>

                    <div v-if="field.type == 'number'" class="mb-6">
                      <label class="mb-2 block text-sm font-semibold capitalize text-gray-700" :for="field.title">
                        {{ field.title }}
                      </label>
                      <input
                        v-model="field.value"
                        type="number"
                        :name="field.title"
                        autocomplete="off"
                        :placeholder="`Enter ${field.title}...`"
                        class="form-input w-full rounded"
                      />
                    </div>

                    <div v-if="field.type == 'date'" class="mb-6">
                      <label class="mb-2 block text-sm font-semibold capitalize text-gray-700" :for="field.title">
                        {{ field.title }}
                      </label>
                      <input
                        v-model="field.value"
                        step="1"
                        :name="field.title"
                        type="datetime-local"
                        :placeholder="`Enter ${field.title}...`"
                        class="form-input w-full rounded"
                      />
                    </div>
                  </div>
                </div>

                <!-- Error Message -->
                <p class="mb-4 text-center text-sm text-red-500" v-if="error">
                  {{ error }}
                </p>

                <!-- Action Buttons -->
                <div class="float-right space-x-4">
                  <button
                    type="button"
                    class="inline-flex justify-center rounded-md border border-transparent bg-gray-100 px-4 py-2 text-sm font-medium text-gray-900 transition hover:bg-gray-200"
                    @click="emit('closeModal')"
                  >
                    Cancel
                  </button>
                  <button
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-green-600"
                  >
                    {{ isEdit ? "Save Changes" : "Add Subscriber" }}
                  </button>
                </div>
              </form>
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import axios from "axios";
import { ref, reactive } from "vue";
import { TransitionRoot, TransitionChild, Dialog, DialogOverlay, DialogTitle } from "@headlessui/vue";

const props = defineProps({
  fields: {
    type: Array,
  },
  subscriberInitialDetails: {
    type: Object,
  },
  isOpen: {
    type: Boolean,
    default: false,
  },
  isEdit: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["onSubscriberCreated", "closeModal"]);

let subscriber = reactive({
  email: props.isEdit ? props.subscriberInitialDetails.email : "",
  name: props.isEdit ? props.subscriberInitialDetails.name : "",
  state: props.isEdit ? props.subscriberInitialDetails.state : "unconfirmed",
  fields: props.isEdit
    ? props.fields.map((field) => {
        const textField = props.subscriberInitialDetails.fields.find(
          (subscriberField) => field.type === "text" && field.title === subscriberField.title
        );
        if (textField) return { ...field, value: textField.pivot.text_value };

        const numberField = props.subscriberInitialDetails.fields.find(
          (subscriberField) => field.type === "number" && field.title === subscriberField.title
        );
        if (numberField) return { ...field, value: numberField.pivot.number_value };

        const dateField = props.subscriberInitialDetails.fields.find(
          (subscriberField) => field.type === "date" && field.title === subscriberField.title
        );
        if (dateField) return { ...field, value: dateField.pivot.number_value };

        const booleanField = props.subscriberInitialDetails.fields.find(
          (subscriberField) => field.type === "boolean" && field.title === subscriberField.title
        );
        if (booleanField) return { ...field, value: booleanField.pivot.number_value };

        return { ...field, value: null };
      })
    : props.fields.map((field) => {
        return { ...field, value: null };
      }),
});

let error = ref("");

async function addSubscriber() {
  if (!subscriber.email) {
    error.value = "Email field is required";
    return;
  }

  if (!subscriber.name) {
    error.value = "Name field is required";
    return;
  }

  let payload = {
    email: subscriber.email,
    name: subscriber.name,
    state: subscriber.state,
    fields: subscriber.fields,
  };

  console.log(payload);

  const apiUrl = props.isEdit
    ? `http://localhost:8000/api/subscribers/${props.subscriberInitialDetails.id}`
    : "http://localhost:8000/api/subscribers";

  await axios({
    method: props.isEdit ? "put" : "post",
    url: apiUrl,
    data: payload,
  })
    .then((response) => {
      if (response.data.success) {
        console.log("Submitted successfully");
      }
    })
    .catch((e) => {
      console.log(e);
    });

  emit("onSubscriberCreated", props.isEdit ? props.subscriberInitialDetails.id : null);
  emit("closeModal");
}
</script>
