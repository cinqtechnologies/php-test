/**
 * Created by Renata on 05/01/2019.
 */

const app = new Vue({
   el: '#app',
   data: {
      pageLoading: true,
      product: {
         id: undefined,
         name: '',
         description: '',
         image: null,
         price: '',
         retailer: {
            name: ''
         },
      }
   },

   mounted(){
      this.product = Object.assign({}, this.product, window.__INITIAL_STATE)
      this.pageLoading = false
      document.getElementById('main-content').style.display = null
   },

   methods: {
      
   }
});

