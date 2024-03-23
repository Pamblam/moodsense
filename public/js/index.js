(async ()=>{

	console.log(DATA);
	let container = document.querySelector('div');

	container.innerHTML = `<div class='container'>
		<div id='calendar'></div>
		<div id='entries'></div>
	</div>`;

	let cal_ele = document.getElementById('calendar');
	let cal_opts = {
		abbrDay: true,
		onEventClick(event){
			console.log('clicked', event);
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