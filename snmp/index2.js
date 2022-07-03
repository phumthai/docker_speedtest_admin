const { get } = require("http");
var snmp = require ("net-snmp");
var mysql = require('mysql');
require('dotenv').config()

var options = {
    port: 161,
    retries: 1,
    timeout: 5000,
    backoff: 1.0,
    transport: "udp4",
    trapPort: 162,
    version: snmp.Version2c,
    backwardsGetNexts: true,
    idBitsSize: 32
};

var shot_count = -1;

var oid_ipuser = "1.3.6.1.4.1.14179.2.1.4.1.2"; // ip user
var oid_user = "1.3.6.1.4.1.14179.2.1.4.1.3"; // User
var oid_mac = "1.3.6.1.4.1.14179.2.1.4.1.4"; // AP Mac
var oid_dot3mac = "1.3.6.1.4.1.14179.2.2.1.1.1"; // AP dot3mac
var oid_name = "1.3.6.1.4.1.14179.2.2.1.1.3" //AP Name

var ipuser_oid = [];
var user_oid = [];
var mac_oid = [];
var dot3mac_oid = [];
var name_oid = [];

var ap_user = [];


function doneCb (error) {
    if (error)
        console.error (error.toString ());
}

function feedCb_user (varbinds) {
    for (var i = 0; i < varbinds.length; i++) {
        if (snmp.isVarbindError (varbinds[i]))
            console.error (snmp.varbindError (varbinds[i]));
        else{
            //console.log (varbinds[i].oid + "|" + varbinds[i].value);
            var x = [];
            var z = varbinds[i].oid;
            z = z.replace('1.3.6.1.4.1.14179.2.1.4.1.3.','');
            var y;
            x.push(z);
            y = "|" + varbinds[i].value;
            y = y.substring(1);
            x.push(y);
            user_oid.push(x);
        }
    }
}

function feedCb_mac (varbinds) {
    for (var i = 0; i < varbinds.length; i++) {
        if (snmp.isVarbindError (varbinds[i]))
            console.error (snmp.varbindError (varbinds[i]));
        else{
            //console.log (varbinds[i].oid + "|" + varbinds[i].value);
            var x = [];
            var z = varbinds[i].oid;
            z = z.replace('1.3.6.1.4.1.14179.2.1.4.1.4.','');
            var y;
            x.push(z);
            y = "|" + varbinds[i].value;
            y = y.substring(1);
            x.push(y);
            mac_oid.push(x);
        }
    }
}

function feedCb_dot3mac (varbinds) {
    for (var i = 0; i < varbinds.length; i++) {
        if (snmp.isVarbindError (varbinds[i]))
            console.error (snmp.varbindError (varbinds[i]));
        else{
            //console.log (varbinds[i].oid + "|" + varbinds[i].value);
            var x = [];
            var z = varbinds[i].oid;
            z = z.replace('1.3.6.1.4.1.14179.2.2.1.1.1.','');
            var y;
            x.push(z);
            y = "|" + varbinds[i].value;
            y = y.substring(1);
            x.push(y);
            dot3mac_oid.push(x);
        }
    }
}

function feedCb_name (varbinds) {
    for (var i = 0; i < varbinds.length; i++) {
        if (snmp.isVarbindError (varbinds[i]))
            console.error (snmp.varbindError (varbinds[i]));
        else{
            //console.log (varbinds[i].oid + "|" + varbinds[i].value);
            var x = [];
            var z = varbinds[i].oid;
            z = z.replace('1.3.6.1.4.1.14179.2.2.1.1.3.','');
            var y;
            x.push(z);
            y = "|" + varbinds[i].value;
            y = y.substring(1);
            x.push(y);
            name_oid.push(x);
        }
    }
}
function feedCb_ipuser (varbinds) {
    for (var i = 0; i < varbinds.length; i++) {
        if (snmp.isVarbindError (varbinds[i]))
            console.error (snmp.varbindError (varbinds[i]));
        else{
            //console.log (varbinds[i].oid + "|" + varbinds[i].value);
            var x = [];
            var z = varbinds[i].oid;
            z = z.replace('1.3.6.1.4.1.14179.2.1.4.1.2.','');
            var y;
            x.push(z);
            y = "|" + varbinds[i].value;
            y = y.substring(1);
            x.push(y);
            ipuser_oid.push(x);
        }
    }
}


var maxRepetitions = 20;

// The maxRepetitions argument is optional, and will be ignored unless using
// SNMP verison 2c

async function firstA(){
    var Controler = [
        "10.71.0.3"
    ]
    for(let i=0;i<Controler.length;i++){
        let session = snmp.createSession (Controler[i], "cmumrtg",options);
        session.subtree (oid_user, maxRepetitions, feedCb_user, doneCb);
        session.subtree (oid_mac, maxRepetitions, feedCb_mac, doneCb);
        session.subtree (oid_dot3mac, maxRepetitions, feedCb_dot3mac, doneCb);
        session.subtree (oid_name, maxRepetitions, feedCb_name, doneCb);
        session.subtree (oid_ipuser, maxRepetitions, feedCb_ipuser, doneCb);
    }
}

async function firstB(){
    var Controler = [
        "10.71.0.7"
    ]
    for(let i=0;i<Controler.length;i++){
        let session = snmp.createSession (Controler[i], "cmumrtg",options);
        session.subtree (oid_user, maxRepetitions, feedCb_user, doneCb);
        session.subtree (oid_mac, maxRepetitions, feedCb_mac, doneCb);
        session.subtree (oid_dot3mac, maxRepetitions, feedCb_dot3mac, doneCb);
        session.subtree (oid_name, maxRepetitions, feedCb_name, doneCb);
        session.subtree (oid_ipuser, maxRepetitions, feedCb_ipuser, doneCb);
    }
}

async function firstC(){
    var Controler = [
        "10.71.0.8"
    ]
    for(let i=0;i<Controler.length;i++){
        let session = snmp.createSession (Controler[i], "cmumrtg",options);
        session.subtree (oid_user, maxRepetitions, feedCb_user, doneCb);
        session.subtree (oid_mac, maxRepetitions, feedCb_mac, doneCb);
        session.subtree (oid_dot3mac, maxRepetitions, feedCb_dot3mac, doneCb);
        session.subtree (oid_name, maxRepetitions, feedCb_name, doneCb);
        session.subtree (oid_ipuser, maxRepetitions, feedCb_ipuser, doneCb);
    }
}

async function firstD(){
    var Controler = [
        "10.71.0.9"
    ]
    for(let i=0;i<Controler.length;i++){
        let session = snmp.createSession (Controler[i], "cmumrtg",options);
        session.subtree (oid_user, maxRepetitions, feedCb_user, doneCb);
        session.subtree (oid_mac, maxRepetitions, feedCb_mac, doneCb);
        session.subtree (oid_dot3mac, maxRepetitions, feedCb_dot3mac, doneCb);
        session.subtree (oid_name, maxRepetitions, feedCb_name, doneCb);
        session.subtree (oid_ipuser, maxRepetitions, feedCb_ipuser, doneCb);
    }
}

async function second(){
    try{
        for(let i=0;i<user_oid.length;i++){
            user_oid[i].push(mac_oid[i][1])         //oid user mac on user side
            user_oid[i].push(ipuser_oid[i][1])
        }
        for(let j=0;j<name_oid.length;j++){
            name_oid[j].push(dot3mac_oid[j][1])     //oid name mac on ap side
        }
    }
    catch(error){
        console.error(error)
        //checkerr();
    }
    
}

async function third(){
    for(let i=0;i<user_oid.length;i++){
        for(let j=0;j<name_oid.length;j++){
            if(user_oid[i][2]==name_oid[j][2]){
                user_oid[i].push(name_oid[j][1])
                break;
            }  
        }  
    }
}

//generates random id;
let guid = () => {
    let s4 = () => {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }
    //return id of format 'aaaaaaaa'-'aaaaaaaa'-'aaaaaaaa'-'aaaa'-'aaaaaaaaaaaa'
    return s4() + s4() + '-' + s4() + s4() + '-' + s4() + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}

async function fouth(){
    for(let i=0;i<user_oid.length;i++){
        let x = [];
        x.push(guid())
        x.push(user_oid[i][1]);
        x.push(user_oid[i][3]);
        x.push(user_oid[i][4]);
        ap_user.push(x)
    }
}

async function fifth(){
    try{
    var con = mysql.createConnection({
        host: process.env.MYSQL_HOST,
            user: process.env.MYSQL_USER,
            password: process.env.MYSQL_PASSWORD,
            database: process.env.MYSQL_DATABASE
    });
      
    con.connect(function(err) {
        if (err) throw err;
        console.log("Connected!");
        var sql = "INSERT INTO user_ap (id, user, ip, apname) VALUES ?";
        var values = ap_user;
        ap_user = [];
        con.query(sql, [values], function (err, result) {
          if (err) throw err;
          console.log("Number of records inserted: " + result.affectedRows);
        });
        setTimeout(function(){
            con.end();
        },5000)
    });
    con.on('end',function(){
        console.log("connection end with mysql server");
    })
    }
    catch(error){
        console.error(error);
    }
}

async function del(){
    try{
    var con = mysql.createConnection({
        host: process.env.MYSQL_HOST,
            user: process.env.MYSQL_USER,
            password: process.env.MYSQL_PASSWORD,
            database: process.env.MYSQL_DATABASE
    });
    con.connect(function(err) {
        if (err) throw err;
        var sql = "DELETE FROM user_ap";
        con.query(sql, function (err, result) {
          if (err) throw err;
          console.log("Number of records deleted: " + result.affectedRows);
        });
        setTimeout(function(){
            con.end();
        },5000)
    });
    }
    catch(err){
        console.error(err);
    }
}

async function A(){
    firstA().then(()=>{
        setTimeout(function(){
            second().then(()=>{
                third().then(()=>{
                    setTimeout(function(){
                        fouth().then(()=>{
                            user_oid = [];
                            mac_oid = [];
                            dot3mac_oid = [];
                            name_oid = [];
                            ipuser_oid = [];
                        })
                    },6000)
                })
            
            })
        },14000)
    })
}

async function B(){
    firstB().then(()=>{
        setTimeout(function(){
            second().then(()=>{
                third().then(()=>{
                    setTimeout(function(){
                        fouth().then(()=>{
                            user_oid = [];
                            mac_oid = [];
                            dot3mac_oid = [];
                            name_oid = [];
                            ipuser_oid = [];
                        })
                    },6000)
                })
            
            })
        },14000)
    })
}

async function C(){
    firstC().then(()=>{
        setTimeout(function(){
            second().then(()=>{
                third().then(()=>{
                    setTimeout(function(){
                        fouth().then(()=>{
                            user_oid = [];
                            mac_oid = [];
                            dot3mac_oid = [];
                            name_oid = [];
                            ipuser_oid = [];
                        })
                    },6000)
                })
            
            })
        },14000)
    })
}

async function D(){
    firstD().then(()=>{
        setTimeout(function(){
            second().then(()=>{
                third().then(()=>{
                    setTimeout(function(){
                        fouth().then(()=>{
                            user_oid = [];
                            mac_oid = [];
                            dot3mac_oid = [];
                            name_oid = [];
                            ipuser_oid = [];
                        })
                    },6000)
                })
            
            })
        },14000)
    })
}

async function final(){
    del().then(()=>{
        A().then(()=>{
            setTimeout(function(){
                B().then(()=>{
                    setTimeout(function(){
                        C().then(()=>{
                            setTimeout(function(){
                                D().then(()=>{
                                    setTimeout(function(){
                                        fifth();
                                    },20500)
                                })
                            },20500)
                        })
                    },20500)
                })
            },20500)
        })
    })
}

final();
setInterval(() => {
    final();
}, 1000*60*8);
