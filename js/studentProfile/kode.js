const componentAddLessons = {
	template: '    <div class="buttonsLessons">\n' +
		'        <div class="math" @click="choice" v-bind:style="{background: math}">математика</div>\n' +
		'        <div class="physics" @click="choice" v-bind:style="{background: physics}">физика</div>\n' +
		'        <div class="inform" @click="choice" v-bind:style="{background: inform}">информатика</div>\n' +
		'    </div>',
	data: function () {
		return {
			math: 'white',
			physics: 'white',
			inform: 'white',
		}
	},
	methods: {
		choice: function (event){
			if (event.path[0].className === "math"){
				this.math = "#55E5FA";
				this.physics = "white";
				this.inform = "white";
			} else if (event.path[0].className === "physics"){
				this.physics = "#55E5FA";
				this.math = "white";
				this.inform = "white";
			} else if(event.path[0].className === "inform"){
				this.inform = "#55E5FA";
				this.math = "white";
				this.physics = "white";
			}
			this.$emit('choice', event.path[0].innerHTML);
		}
	}
}

const componentCalendar = {
	template:
	'<div class="calendar">\n' +
		'            <div class="head">\n' +
		'                <button @click = "back">\n' +
		'                    <img src="../img/back1.svg">\n' +
		'                </button>\n' +
		'                <div>\n' +
		'                    <span class="months">{{months}}</span>\n' +
		'                    <span class="year">{{numYear}}</span>\n' +
		'                </div>\n' +
		'                <button @click = "forward">\n' +
		'                    <img src="../img/forward.svg">\n' +
		'                </button>\n' +
		'            </div>\n' +
		'            <div class="body">\n' +
		'                <div class="days">\n' +
		'                    <span>пн</span>\n' +
		'                    <span>вт</span>\n' +
		'                    <span>ср</span>\n' +
		'                    <span>чт</span>\n' +
		'                    <span>пт</span>\n' +
		'                    <span>сб</span>\n' +
		'                    <span>вс</span>\n' +
		'                </div>\n' +
		'                <div class="calendarDate" ref="calendarDate">\n' +
		' 				 	<div v-for = "week in arrayDate">' +
		'						<template  v-for = "date in week">' +
		' 							<div @click = "choice" class="toDay" v-if = "date==toDay && toMonths==numMonths && toYear==numYear">{{date}}</div>' +
		'							<div @click = "choice" v-else>{{date}}</div>'+
		'						</template>' +
		'					</div> \n' +
		'                </div>\n' +
		'            </div>\n' +
		'        </div>',
	data: function () {
		var date = new Date()
		var strMonths=this.getMonth(date.getMonth())
		return {
			numMonths: null,
			numYear: null,
			months: null,
			arrayDate: null,
			toDay: date.getDate(),
			toMonths: date.getMonth(),
			toYear: date.getFullYear()
		}
	},
	mounted() {
		let d = new Date()
		this.rendering(d)
	},
	methods: {
		getMonth(num) {
			if (num==0){
				return "Январь"
			} else if (num==1){
				return "Февраль"
			}
			else if (num==2){
				return "Март"
			} else if (num==3){
				return "Апрель"
			} else if (num==4){
				return "Май"
			} else if (num==5){
				return "Июнь"
			} else if (num==6){
				return "Июль"
			} else if (num==7){
				return "Август"
			} else if (num==8){
				return "Сентябрь"
			} else if (num==9){
				return "Октябрь"
			} else if (num==10){
				return "Ноябрь"
			} else if (num==11){
				return "Декабрь"
			}
		},
		choice(event){
			let d = new Date(this.numYear, this.numMonths, event.path[0].innerHTML)
			this.$emit('choice', d)
		},
		rendering(d){
			let strMonths=this.getMonth(d.getMonth())

			this.numMonths = d.getMonth()
			this.numYear =  d.getFullYear()
			this.months =  strMonths
			// this.toDay =  d.getDate()

			let arrayDate = []
			let months = d.getMonth()
			// let date = d.getDate()
			let year = d.getFullYear()
			d = new Date(year, months, 1);
			let day = d.getDay()-1
			for (let i=0; i<6; i++){
				arrayDate[i] = []
				for (let j=0; j<7; j++){
					if (i===0 && j<day){
						arrayDate[i][j] = ''
					} else if (d.getMonth()===months){
						arrayDate[i][j] = d.getDate()
						d.setDate(d.getDate()+1)
					} else {
						arrayDate[i][j] = ''
					}
				}
			}
			this.arrayDate = arrayDate
		},
		back(){
			if (this.numMonths-1<0){
				this.numYear=this.numYear-1
				this.numMonths=11
			} else {
				this.numMonths=this.numMonths-1
			}
			let d = new Date(this.numYear, this.numMonths, 1)
			this.rendering(d)
		},
		forward(){
			if (this.numMonths+1>11){
				this.numYear=this.numYear+1
				this.numMonths=0
			} else {
				this.numMonths=this.numMonths+1
			}
			let d = new Date(this.numYear, this.numMonths, 1)
			this.rendering(d)
		}
	}
}

const componentMsg = {
	props: ['text', 'sender', 'date'],
	template:
		'				<div>'+
		'					<div class="text">{{text}}'+
		'					</div>'+
		'					<div class="sender">{{sender}}</div>'+
		'					<div class="msg-date">{{date}}</div>'+
		'				</div>',
}

const componentMessenger = {
	components: {
		'msg': componentMsg,
	},

	template:
		'<div class="messenger">'+
		'	<div class="msges" ref="msges">' +
		'		<template v-for="(item, index) in arrayMsg">'+
		'			<msg v-bind:class="classMsg(index)" ' +
		'					v-bind:text = "item.text" v-bind:sender = "item.sender" v-bind:date = "item.date" >'+
		'			</msg>'+
		'		</template>'+
		'	</div>'+
		'	<div>'+
		' 		<textarea ref="textarea" @input="funkInput($event.target.value)" rows="5" class="text"/>'+
		'		<button @click="send" style=" margin-left: 90%">'+
		'			<img src="../../img/send.svg" style="width: 30px; hight: auto;">'+
		'		</button>'+
		'	</div>'+
		'</div>',

	data: function () {
		return {
			arrayMsg: null,
			text: null,
			name: null
		}
	},

	beforeCreate() {
		axios.post('../vendor/getMesseges.php',{
		})
			.then(response => {
				this.arrayMsg = (this.arrayForHtml(response.data['array'], response.data['nameOfStudent']))
				this.name = response.data['nameOfStudent']
			});
	},

	methods: {
		classMsg(index){
			return this.arrayMsg[index]['class1']
		},
		arrayForHtml(array, name){
			let rezult = []
			array.forEach(function callback(currentValue, index, array) {
				rezult[index] = []
				rezult[index]['text'] = currentValue['content']
				rezult[index]['sender'] = currentValue['sender']
				rezult[index]['date'] = currentValue['date']

				if (rezult[index]['sender'] === name){
					rezult[index]['class1'] = 'msgStudent'
				} else {
					rezult[index]['class1'] = 'msgTutor'
				}
			})
			return rezult
		},
		funkInput(value){
			this.text = value
		},
		send(){
			console.log(this.text)
			let d = new Date()
			let h = d.getHours()
			let min = d.getMinutes()
			let date = app.getDate(d)
			date = app.dateForPHP(date)
			date = date + ' '+h+':'+min

			axios.post('../vendor/sendMsg.php',{
				date: date,
				msg: this.text
			})
				.then(response => {
					let elem_msg = document.createElement('div');
					elem_msg.className = 'msgStudent';

					let text_msg = document.createElement('div');
					text_msg.className = 'text';
					text_msg.append(this.text)
					let sender = document.createElement('div');
					sender.className = 'sender';
					sender.append(this.name)
					let text_date = document.createElement('div');
					text_date.className = 'msg-date';
					text_date.append(date)

					elem_msg.append(text_msg)
					elem_msg.append(sender)
					elem_msg.append(text_date)

					this.$refs.msges.append(elem_msg)
				});

			this.$refs.textarea.value = ""

		}
	},
}




var app = new Vue({
	el: '#shedule',

	components: {
		'component-a': componentAddLessons,
		'calendar': componentCalendar,
		'dialogue': componentMessenger,
	},

	data(){
		let d = new Date()
		return {
			date: this.getDate(d),
			arrayLessons: '',
			arrayNameLessons: '',
			tableShedule_display: 'block',
			scrin: 1,
			freeTimes: null,
			choiceTime: new Set(),
			choiceLesson: null,
			previousScreen: null
		}
	},
	methods: {
		funcChoiceLesson: function(subject){
			this.choiceLesson = subject
		},

		functionChoiceDate: function(date){
			this.date = this.getDate(date)
			this.redrawFirstScreen()
			this.logout()

		},

		funcChoiceTime: function(event){
			if (!event.path[0].classList.contains("choiceTime")){
				event.path[0].classList.add("choiceTime")
				this.choiceTime.add(event.path[0].innerHTML)
			} else {
				event.path[0].classList.remove("choiceTime")
				this.choiceTime.delete(event.path[0].innerHTML)
				console.log(this.choiceTime)
			}
		},

		dateForPHP: function(date){
			let rezult = date.slice(6,10)+'-'+date.slice(3,5)+'-'+date.slice(0,2)
			return rezult
		},
		getDate: function (date){
			// let date = new Date()
			let str = ''
			if (Number(date.getDate())<10) {
				str = str+0
			}
			str = str+date.getDate()+'.'
			if (Number(date.getMonth()+1)<10) {
				str = str+0
			}
			str = str+Number(date.getMonth()+1)+'.'
			str = str+date.getFullYear()
			return str
		},
		getArrayLessons(array){
			let arrayLessons = [false, false, false, false, false, false, false, false, false, false, false, false]
			let arrayNameLessons = ['', '', '', '', '', '', '', '', '', '', '', '']
			array.forEach(function(item, i, arr) {
				arrayLessons[Number(item['timeBegining'].slice(0,2))-9] = true
				arrayNameLessons[Number(item['timeBegining'].slice(0,2))-9] = item['idSubject']
			});
			this.arrayLessons = arrayLessons
			this.arrayNameLessons = arrayNameLessons
		},

		deleteLesson: function (event){
			let elem = event.path[3]
			let time = elem.childNodes[0].textContent
			this.arrayLessons[Number(time)-9]=false

			let lesson = elem.childNodes[2]
			elem.removeChild(lesson)

			axios.post('../vendor/deleteLesson.php',{
				date: this.dateForPHP(this.date),
				time: time
			})
				.then(response => {
					if (response.data){
					}
				});
		},

		logout: function(){
			if (this.scrin==1) {
				window.location.href = '../vendor/logout.php';
			} else if (this.scrin==2) {
				this.tableShedule_display = 'block'
				this.scrin--
			} else if (this.scrin==4){
				this.scrin = this.previousScreen
				if (this.previousScreen == 1){
					this.tableShedule_display = 'block'
				}
			} else if (this.scrin==3){
				this.tableShedule_display = 'block'
				this.scrin = 1
			}
		},

		addLessons: function (){
			if (this.scrin==1) {
				this.tableShedule_display = 'none'
				this.showTime()
				this.scrin++
			} else if (this.scrin==2){
				if (this.choiceTime.size === 0 || this.choiceLesson == null){
					alert("Выберете предмет и время урока");
				} else {
					// console.log(Array.from(this.choiceTime))
					axios.post('../vendor/addLesson.php',{
						date: this.dateForPHP(this.date),
						choiceLesson: this.choiceLesson,
						choiceTime: Array.from(this.choiceTime)
					})
						.then(response => {
							if (response){
								if (!response.data['rezult']){
									alert(response.data['msg'])
								} else {
									alert(response.data['msg'])
									this.redrawFirstScreen()
									this.logout()
								}
							}
						});
				}
			}
		},

		showTime: function (){
			axios.post('../vendor/getTimeLessons.php',{
				date: this.dateForPHP(this.date)
			})
				.then(response => {
					if (response){
						this.freeTimes = response.data.arrayTimeLessons
					}
				});
		},

		dialogue: function (){
			this.previousScreen = this.scrin
			this.scrin = 3
			this.tableShedule_display = 'none'
		},

		calendar: function (){
			this.previousScreen = this.scrin
			this.scrin = 4
			this.tableShedule_display = 'none'
		},

		redrawFirstScreen(){
			axios.post('../vendor/getShedule.php',{
				date: this.dateForPHP(this.date)
			})
				.then(response => {
					if (response){
						this.getArrayLessons(response.data.schedule)
					}
				});
		}
	},
	mounted() {
		this.redrawFirstScreen()
	}
});



