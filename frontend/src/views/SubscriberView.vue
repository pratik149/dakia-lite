<template>
  <main class="flex h-full flex-auto flex-col bg-gray-100">
    <div class="mx-auto w-full max-w-8xl px-4 py-8">
      <h1 class="mb-8 text-3xl font-semibold">{{ subscriber.email }}</h1>

      <div class="rounded bg-white">
        <div class="px-6 py-6">
          <div class="flex justify-between">
            <h2 class="mb-2 text-lg font-bold text-gray-800">Subscriber details</h2>
            <div>
              <button
                @click="toggleAddSubscriberModal"
                class="mr-2 rounded bg-gray-200 px-4 py-1.5 text-sm font-medium text-gray-600"
              >
                Edit
              </button>
              <button
                @click="toggleDeleteSubscriberModal"
                class="rounded bg-red-100 px-4 py-1.5 text-sm font-medium text-red-600"
              >
                Delete
              </button>
            </div>
          </div>

          <div class="text-sm">
            <div class="flex border-b py-4">
              <label class="w-1/2">Email</label>
              <p class="w-1/2 font-semibold">{{ subscriber.email }}</p>
            </div>

            <div class="flex border-b py-4">
              <label class="w-1/2">Name</label>
              <p class="w-1/2 font-semibold">{{ subscriber.name }}</p>
            </div>

            <div class="flex border-b py-4">
              <label class="w-1/2">Subscribed on</label>
              <p class="w-1/2 font-semibold">{{ subscriber.created_at }}</p>
            </div>

            <div class="flex border-b py-4 last:border-b-0">
              <label class="w-1/2">State</label>
              <p class="w-1/2 font-semibold capitalize">{{ subscriber.state }}</p>
            </div>

            <div v-for="field in subscriber.fields" :key="field.id" class="border-b py-4 last:border-b-0">
              <span v-if="field.type === 'text'" class="flex">
                <label class="w-1/2 capitalize">{{ field.title }}</label>
                <p class="w-1/2 font-semibold">{{ field.pivot.text_value }}</p>
              </span>

              <span v-if="field.type === 'number'" class="flex">
                <label class="w-1/2 capitalize">{{ field.title }}</label>
                <p class="w-1/2 font-semibold">{{ field.pivot.number_value }}</p>
              </span>

              <span v-if="field.type === 'date'" class="flex">
                <label class="w-1/2 capitalize">{{ field.title }}</label>
                <p class="w-1/2 font-semibold">{{ field.pivot.date_value }}</p>
              </span>

              <span v-if="field.type === 'boolean'" class="flex">
                <label class="w-1/2 capitalize">{{ field.title }}</label>
                <p class="w-1/2 font-semibold">{{ field.pivot.boolean_value }}</p>
              </span>
            </div>
          </div>
        </div>
      </div>

      <ConfirmationModal
        :is-open="isDeleteSubscriberModalOpen"
        title="Delete"
        subtitle="Are you sure you want to delete?"
        @on-cancellation="toggleDeleteSubscriberModal"
        @on-confirmation="deleteSubscriber(subscriber.id)"
      />

      <AddSubscriber
        v-if="isAddSubscriberModalOpen"
        :is-open="isAddSubscriberModalOpen"
        :fields="fields"
        :subscriber-initial-details="subscriber"
        :is-edit="true"
        @close-modal="toggleAddSubscriberModal"
        @on-subscriber-created="getSubscriber"
      />
    </div>
  </main>
</template>

<script>
import ConfirmationModal from "../components/ConfirmationModal.vue";
import AddSubscriber from "../components/AddSubscriber.vue";
export default {
  components: {
    ConfirmationModal,
    AddSubscriber,
  },
  data() {
    return {
      subscriber: {},
      fields: [],
      isDeleteSubscriberModalOpen: false,
      isAddSubscriberModalOpen: false,
    };
  },
  created() {
    this.getSubscriber(this.$route.params.id);
    this.getFields();
  },
  methods: {
    async getSubscriber(id) {
      await this.$axios
        .get(`/subscribers/${id}`)
        .then((response) => {
          this.subscriber = response.data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async deleteSubscriber(id) {
      await this.$axios
        .delete(`/subscribers/${id}`)
        .then((response) => {
          if (response.data.success) {
            this.$router.push("/subscribers");
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async getFields() {
      await this.$axios
        .get("/fields")
        .then((response) => {
          this.fields = response.data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    toggleDeleteSubscriberModal() {
      this.isDeleteSubscriberModalOpen = !this.isDeleteSubscriberModalOpen;
    },
    toggleAddSubscriberModal() {
      this.isAddSubscriberModalOpen = !this.isAddSubscriberModalOpen;
    },
  },
};
</script>
