(async ()=>{

	console.log(DATA);
	let container = document.querySelector('div');

	container.innerHTML = `
	<img src='./img/logo.png' class='img-fluid' style='margin: 0 auto;' />
	<div class='container'>
		<div id='calendar'></div>
		<div id='entries'></div>
	</div>`;

	let cal_ele = document.getElementById('calendar');
	let entries_ele = document.getElementById('calendar');

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

	let cal_opts = {
		abbrDay: true,
		onDayClick(date){
			let month = `${date.getMonth()+1}`.padStart(2,'0');
			let day = `${date.getDate()}`.padStart(2,'0');
			let d = `${date.getFullYear()}-${month}-${day}`;
			console.log(d);
			if(DATA[d]){
				let mood_face = DATA[d].avg > 7 ? '😡' : (DATA[d].avg > 3 ? '😐' : '😄');
				let mood_text = DATA[d].avg > 7 ? 'bad' : (DATA[d].avg > 3 ? 'neutral' : 'good');

				entries_ele.innerHTML = `
					<p class='text-center'><b>${DATA[d].entries.length} entr${DATA[d].entries.length===1?'y':'ies'} on ${d}</b></p>
					<p class='text-center'><small>${mood_face} Your over-all mood was ${mood_text} on this day (${DATA[d].avg} out of 10).</small></p>
					${DATA[d].entries.map(entry=>{
						return `<div class='econtainer'>
							<div class='entry-box'>${entry.entry}</div>
							<div class='entry-box'>${entry.response}</div>
						</div>`;
					}).join('')}
				`;
			}else{
				entries_ele.innerHTML = `<p><b>No entries on ${d}</b></p>`;
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

	console.log(container);

})();