// indexedDBSetup.js
let db;

function openIndexedDB() {
    let request = indexedDB.open("KelurahanDatabase", 1);

    request.onerror = function (event) {
        console.log("Database error: " + event.target.errorCode);
    };

    request.onsuccess = function (event) {
        db = event.target.result;
    };

    request.onupgradeneeded = function (event) {
        let db = event.target.result;
        db.createObjectStore("kelurahanData", { keyPath: "kelurahan" });
    };
}

openIndexedDB();
