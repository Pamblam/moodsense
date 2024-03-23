(async ()=>{

	let container = document.querySelector('div');

	container.innerHTML = `
	<div class='container'>
		<div class='text-center m-5'>
			<img src='./img/logo.png' class='img-fluid' style='margin: 0 auto; max-width: 80%;' />
		</div>
		<div class='alert alert-info'>
			<p class="m-0">Click on any date in the calendar to view the average mood rating and journal logs.</p>
		</div>
		<div id='calendar'></div>
		<div id='entries' class='mb-5'></div>
		<div class='text-center text-muted mb-3'>By Pam Mishaw &amp; Rob Parham &centerdot; TadHacks 2024<small></small></div>
	</div>`;

	let cal_ele = document.getElementById('calendar');
	let entries_ele = document.getElementById('entries');

	let events = Object.keys(DATA).map(dte=>{
		let date = new Date(DATA[dte].entries[0].ts*1000);
		return {
		  desc: `Average: `+DATA[dte].avg,
		  date: date,
		  entries: DATA[dte].entries
		};
	})

	let colors = [
		'0000ff',
		'1700e8',
		'3600c9',
		'5200ad',
		'73008c',
		'94006b',
		'ab0054',
		'ca0035',
		'dc0023',
		'ff0000'
	];

	let emojis = [
		'😄',
		'😃',
		'😀',
		'🙂',
		'😐',
		'😕',
		'🙁',
		'😟',
		'😞',
		'😫'
	];

	let mood_adjectives = [
		'really good',
		'pretty good',
		'good',
		'decent',
		'neutral',
		'poor',
		'bad',
		'pretty bad',
		'really bad',
		'terrible'
	];

	let active_element = null;

	let cal_opts = {
		abbrDay: true,
		onDayClick(date){
			let month = `${date.getMonth()+1}`.padStart(2,'0');
			let day = `${date.getDate()}`.padStart(2,'0');
			let d = `${date.getFullYear()}-${month}-${day}`;

			if(active_element) active_element.style.outline = null;
			active_element = document.querySelector(`.cjs-dayCol[data-date="${+month}/${day}/${date.getFullYear()}"]`)
			active_element.style.outline = `3px solid lightgreen`;

			if(DATA[d]){
				let scale = Math.round(DATA[d].avg)-1;
				let mood_face = emojis[scale];
				let mood_text = mood_adjectives[scale];

				entries_ele.innerHTML = `<div class='m-3'>
						<p class='text-center'><b>${DATA[d].entries.length} entr${DATA[d].entries.length===1?'y':'ies'} on ${d}</b></p>
						<p class='text-center'><small>${mood_face} Your over-all mood was <b>${mood_text}</b> on this day (${DATA[d].avg} out of 10).</small></p>
						<hr>
						${DATA[d].entries.map(entry=>{
							var dte = new Date().toLocaleTimeString();
							var p = dte.split(/\D/);
							var mer = dte.split(' ').pop();
							let time = `${p[0]}:${p[1]} ${mer}`;

							let scale = Math.round(entry.rating)-1;
							let mood_face = emojis[scale];
							let mood_text = mood_adjectives[scale];

							return `<div class='econtainer mb-3'>
								<div class='mb-3'><b>${time}</b> (Mood: ${mood_face} ${entry.rating}/10)</div>
								<div class='entry-box mb-3'>${entry.entry}</div>
								<div class='entry-box text-muted'><small><i><b>Response:</b> ${entry.response}</i></small></div>
							</div>`;

						}).join('<hr>')}
					</div>
				`;
			}else{
				entries_ele.innerHTML = `<p class='text-center my-3'><b>No entries on ${d}</b></p>`;
			}
		},
		afterDraw(){
			document.querySelectorAll('.cjs-dayCol[data-date]').forEach(ele=>{
				let date = ele.dataset.date;
				let [m,d,y] = date.split("/");
				date = `${y}-${`${m}`.padStart(2,'0')}-${`${d}`.padStart(2,'0')}`;
				if(DATA[date]){
					let color = colors[Math.round(DATA[date].avg)-1];
					ele.style.backgroundColor = `#${color}`;
					ele.querySelector('.cjs-dateLabel').style.color = `#FFF`;
				}
			});
		}
	};
	let cal = new calendar(cal_ele, cal_opts);

	Object.keys(DATA).forEach(dte=>{
		let date = new Date(dte.ts*1000);
		cal.addEvent({
			desc: DATA.avg,
			date: date,
			entries: DATA[dte].etries
		});
	})

})();