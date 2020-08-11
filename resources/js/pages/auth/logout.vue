<template>
  <div></div>
</template>

<script>
import Axios from 'axios'
export default {
    created(){
        User.clearStore();
        Toast.fire({
            icon: 'success',
            title: 'Log Out successfully'
          });
        this.$router.push({name: 'login'});
    }
}
</script>

<style>

</style>