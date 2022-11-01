function padTo2Digits(num) {
  return num.toString().padStart(2, "0");
}

function formatDate(date) {
  return [
    padTo2Digits(date.getDate()),
    padTo2Digits(date.getMonth() + 1),
    date.getFullYear(),
  ].join("/");
}

function formatTime(date) {
  return padTo2Digits(date.getHours()) + ":" + padTo2Digits(date.getMinutes());
  // + ":" + date.getSeconds();
}

function formatDatetime(date) {
  const $date = [
    date.getFullYear(),
    padTo2Digits(date.getMonth() + 1),
    padTo2Digits(date.getDate()),
  ].join("-");

  return $date + "T" + formatTime(date);
}
