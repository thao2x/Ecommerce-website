<template>
  <div>
    <Loading v-if="loading" />
    <template v-else>
      <router-view />
      <BottomNavigation />
    </template>
  </div>
</template>

<script>
import Loading from "@/components/Loading"
import BottomNavigation from "@/components/BottomNavigation"

import { getUser, getCategories, getPromos, getPopulars, getCart, getAddress } from "@/api"

export default {
  data() {
    return {
      loading: true
    }
  },

  components: {
    Loading,
    BottomNavigation
  },

  created() {
    this.init();
  },

  methods: {
    init() {
      const self = this;

      Promise.allSettled([getCategories(), getPromos(), getPopulars(), getUser(), getCart(), getAddress()])
        .then((result) => {
          // Lưu vào data vào store
          self.$store.commit('changeCategories', result[0].value.data.data);
          self.$store.commit('changePromos', result[1].value.data.data);
          self.$store.commit('changePupulars', result[2].value.data.data);

          // Trường hợp User chưa login, call api bị lỗi
          if (result[3].status == "rejected") {
            throw new Error(result[3].reason);
          }

          // Lưu vào User vào store
          self.$store.commit('changeUser', result[3].value.data.data);
          self.$store.commit('changeCartItems', result[4].value.data.data);
          self.$store.commit('changeAddress', result[5].value.data.data[0]);
        })
        .catch((error) => {
          // console.log(error);
        }).finally(() => {
          // Ẩn loading
          self.loading = false;
        });
    }
  }
}
</script>