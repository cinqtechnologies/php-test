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
      },
      form: {
         email: ''
      },
      loading: false,
      showSuccess: false
   },

   mounted(){
      this.product = Object.assign({}, this.product, window.__INITIAL_STATE)
      this.pageLoading = false
      document.getElementById('main-content').style.display = null
   },

   methods: {
      sendEmail(){
         this.loading = true

         axios
            .post('/product/'+this.product.id+'/send-details', { email: this.form.email })
            .then(res => {
               console.log(res)
               if (res.data.success){
                  this.form.email = ''
                  this.showSuccess = true
               }
            })
            .catch(error => console.log(error))
            .then( () => {
               this.loading = false
            })
      }
   }
});

