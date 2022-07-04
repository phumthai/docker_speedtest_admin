require('dotenv').config()
const { get } = require("http");
var snmp = require ("net-snmp");
var mysql = require('mysql');
const community_key = process.env.community_key
const MYSQL_HOST = process.env.MYSQL_HOST
const MYSQL_USER = process.env.MYSQL_USER
const MYSQL_PASSWORD = process.env.MYSQL_PASSWORD
const MYSQL_DATABASE = process.env.MYSQL_DATABASE

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

const oid_apname = "1.3.6.1.4.1.14179.2.2.1.1.3" //AP Name
const oid_utilize = "1.3.6.1.4.1.14179.2.2.13.1.3" //AP utilize
const oid_clientnum = "1.3.6.1.4.1.14179.2.2.13.1.4" //AP utilize

var data = [];
var apname = [];
var aputilize = [];
var clientnum = [];

let guid = () => {
    let s4 = () => {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }
    //return id of format 'aaaaaaaa'-'aaaaaaaa'-'aaaaaaaa'-'aaaaaaaa'-'aaaaaaaa'
    return s4() + s4() + '-' + s4() + s4() + '-' + s4() + s4() + '-' + s4() + s4() + '-' + s4() + s4();
}

function doneCb (error) {
    if (error)
        console.error (error.toString ());
}

function feedCb_apname (varbinds) {
    for (let i = 0; i < varbinds.length; i++) {
        if (snmp.isVarbindError (varbinds[i]))
            console.error (snmp.varbindError (varbinds[i]));
        else{
            //console.log (varbinds[i].oid + "|" + varbinds[i].value);
            let x = [];
            let z = varbinds[i].oid;
            z = z.replace('1.3.6.1.4.1.14179.2.2.1.1.3.','');
            let y;
            x.push(z);
            y = "|" + varbinds[i].value;
            y = y.substring(1);
            x.push(y);
            apname.push(x);
        }
    }
}

function feedCb_aputilize (varbinds) {
    for (let i = 0; i < varbinds.length; i++) {
        if (snmp.isVarbindError (varbinds[i]))
            console.error (snmp.varbindError (varbinds[i]));
        else{
            //console.log (varbinds[i].oid + "|" + varbinds[i].value);
            let x = [];
            let z = varbinds[i].oid;
            z = z.replace('1.3.6.1.4.1.14179.2.2.13.1.3.','');
            let y;
            x.push(z);
            y = "|" + varbinds[i].value;
            y = y.substring(1);
            x.push(y);
            aputilize.push(x);
        }
    }
}

function feedCb_clientnum (varbinds) {
    for (let i = 0; i < varbinds.length; i++) {
        if (snmp.isVarbindError (varbinds[i]))
            console.error (snmp.varbindError (varbinds[i]));
        else{
            //console.log (varbinds[i].oid + "|" + varbinds[i].value);
            let x = [];
            let z = varbinds[i].oid;
            z = z.replace('1.3.6.1.4.1.14179.2.2.13.1.4.','');
            let y;
            x.push(z);
            y = "|" + varbinds[i].value;
            y = y.substring(1);
            x.push(y);
            clientnum.push(x);
        }
    }
}

var maxRepetitions = 20;

async function firstA(){
    var Controler = [
        "10.71.0.34"
    ]
    for(let i=0;i<Controler.length;i++){
        let session = snmp.createSession (Controler[i], community_key,options);
        session.subtree (oid_apname, maxRepetitions, feedCb_apname, doneCb);
        session.subtree (oid_utilize, maxRepetitions, feedCb_aputilize, doneCb);
        session.subtree (oid_clientnum, maxRepetitions, feedCb_clientnum, doneCb);
    }
}

async function firstB(){
    var Controler = [
        "10.71.0.45"
    ]
    for(let i=0;i<Controler.length;i++){
        let session = snmp.createSession (Controler[i], community_key,options);
        session.subtree (oid_apname, maxRepetitions, feedCb_apname, doneCb);
        session.subtree (oid_utilize, maxRepetitions, feedCb_aputilize, doneCb);
        session.subtree (oid_clientnum, maxRepetitions, feedCb_clientnum, doneCb);
    }
}

async function firstC(){
    var Controler = [
        "10.71.0.46"
    ]
    for(let i=0;i<Controler.length;i++){
        let session = snmp.createSession (Controler[i], community_key,options);
        session.subtree (oid_apname, maxRepetitions, feedCb_apname, doneCb);
        session.subtree (oid_utilize, maxRepetitions, feedCb_aputilize, doneCb);
        session.subtree (oid_clientnum, maxRepetitions, feedCb_clientnum, doneCb);
    }
}

async function firstD(){
    var Controler = [
        "10.71.0.47"
    ]
    for(let i=0;i<Controler.length;i++){
        let session = snmp.createSession (Controler[i], community_key,options);
        session.subtree (oid_apname, maxRepetitions, feedCb_apname, doneCb);
        session.subtree (oid_utilize, maxRepetitions, feedCb_aputilize, doneCb);
        session.subtree (oid_clientnum, maxRepetitions, feedCb_clientnum, doneCb);
    }
}

async function firstE(){
    var Controler = [
        "10.71.0.48"
    ]
    for(let i=0;i<Controler.length;i++){
        let session = snmp.createSession (Controler[i], community_key,options);
        session.subtree (oid_apname, maxRepetitions, feedCb_apname, doneCb);
        session.subtree (oid_utilize, maxRepetitions, feedCb_aputilize, doneCb);
        session.subtree (oid_clientnum, maxRepetitions, feedCb_clientnum, doneCb);
    }
}

async function second(){
    for(let i=0;i<apname.length;i++){
        let collect = [];
        let id = i.toString();
        collect.push(id);
        collect.push(apname[i][1]);
        collect.push(aputilize[i*2][1]);
        collect.push(aputilize[(i*2)+1][1]);
        collect.push(clientnum[i*2][1]);
        collect.push(clientnum[(i*2)+1][1]);
        data.push(collect);
    }
}


async function insertsql(){
    try{
        var con = mysql.createConnection({
            host: MYSQL_HOST,
            user: MYSQL_USER,
            password: MYSQL_PASSWORD,
            database: MYSQL_DATABASE
        });
      
        con.connect(function(err) {
            if (err) throw err;
            console.log("Connected!");
            var sqld = "DELETE FROM snmp";
            con.query(sqld, function (err, result) {
                if (err) throw err;
                    console.log("Number of records deleted: " + result.affectedRows);
            });
            var sql = "INSERT INTO snmp (id, apname, utilize24, utilize5, clientnum24, clientnum5) VALUES ?";
            var values = data;
            data = [];
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

async function start(){
    firstA().then(()=>{
        setTimeout(function(){
            firstB().then(()=>{
                setTimeout(function(){
                    firstC().then(()=>{
                        setTimeout(function(){
                            firstD().then(()=>{
                                setTimeout(function(){
                                    firstE().then(()=>{
                                        setTimeout(function(){
                                            second().then(()=>{
                                                setTimeout(function(){
                                                    insertsql().then(()=>{
                                                        setTimeout(function(){
                                                            data = [];
                                                            apname = [];
                                                            aputilize = [];
                                                            clientnum = [];
                                                        },5000)
                                                    })
                                                },5000)
                                            })
                                        },10000)
                                    })
                                },10000)
                            })
                        },10000)
                    })
                },10000)
            })
        },10000)
    })
}

start();
setInterval(() => {
    start();
}, 1000*60*10);



