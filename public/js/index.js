(async ()=>{

	console.log(DATA);
	let container = document.querySelector('div');

	container.innerHTML = `<div class='container'>
		<div id='calendar'></div>
		<div id='entries'></div>
	</div>`;

	let cal_ele = document.getElementById('calendar');

	let events = Object.keys(DATA).map(dte=>{
		let date = new Date(DATA[dte].entries[0].ts*1000);
		return {
		  desc: `Average: `+DATA[dte].avg,
		  date: date,
		  entries: DATA[dte].entries
		};
	})

	let cal_opts = {
		abbrDay: true,
		onEventClick(event){
			console.log('clicked', event);
		},
		afterDraw(){
			document.querySelectorAll('.cjs-dayCol[data-date]').forEach(ele=>{
				let date = ele.dataset.date;
				let [m,d,y] = date.split("/");
				date = `${y}-${`${m}`.padEnd(2,'0')}-${`${d}`.padEnd(2,'0')}`;
				if(DATA[date]){
					console.log(date);
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