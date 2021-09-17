var app = new Vue({
	el: '#formLog',

	data(){
		return {
			log: null,
			pass: null,
			error: null
		}
	},

	methods: {
		send: function(event){
			if (this.log == null || this.pass == null){
				this.error = "Проверьте заполнение полей"
			} else {
				this.postLogin()
			}
		},
		postLogin(){
			axios.post('vendor/login.php',{
				login: this.log,
				password: this.pass
			})
			.then(response => {
				if (response.data.student && response.data.status){
					window.location.href = "studentProfile/index.php"
				} else if (response.data.tutor && response.data.status){
					window.location.href = "tutorProfile/index.php"
				}
				else if (!response.data.status) {
					this.error = response.data.message
				}
			});
		}
	}
})

