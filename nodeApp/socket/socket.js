// Manage socket request
module.exports = {

	init: function(){
		ios.on('connection',function(socket){
			console.log('connection established');	

			// join room
			socket.on('joinRoom', function(room){
				socket.join(room);
			});

			/**
			 * apply rules at user system 
			 */

			// set user system log monitoring interval time
			socket.on('system-monitor-interval', function(system, intervalTime){
				ios.to(system).emit('monitor-interval', intervalTime);
			});

			// set user system log monitoring interval time
			socket.on('system-snapshot-interval', function(system, intervalTime){ 
				ios.to(system).emit('screenshot-interval', intervalTime);
			});

			// set user system log monitoring interval time
			socket.on('system-snapshot-dimension', function(system, height, width){
				ios.to(system).emit('screenshot-dimension', height, width);
			});

			// set user system screenshot notification message
			socket.on('system-snapshot-popupMessage', function(system, message){
				ios.to(system).emit('screenshot-popupMessage', message);
			});

			/**
			 * End apply rules section
			 */

			/**
			 * Apply restrictions to user system
			 */

			 // apply restriction to user system
			 socket.on('system-apply-restriction-all', function(domain){
			 	console.log('apply restrcition all == domain=>'+domain);
			 	socket.broadcast.emit('apply-restriction-all', domain);
			 });

			 // remove restriction to user system
			 socket.on('system-remove-restriction-all', function(domain){
			 	console.log('remove restrcition all == domain=>'+domain);
			 	socket.broadcast.emit('remove-restriction-all', domain);
			 });

			 // apply restriction to user system
			 socket.on('system-apply-restriction', function(system, domain){
			 	console.log('apply restrcition system=>'+system+'  == domain=>'+domain);
			 	ios.to(system).emit('apply-restriction', domain);
			 });

			 // remove restriction to user system
			 socket.on('system-remove-restriction', function(system, domain){
			 	console.log('remove restrcition');
			 	console.log('apply restrcition system=>'+system+'  == domain=>'+domain);
			 	ios.to(system).emit('remove-restriction', domain);
			 });

			/**
			 * End apply restriction to user system
			 */ 

		});
	}
}