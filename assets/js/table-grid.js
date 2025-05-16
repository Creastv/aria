(function($) {
$(document).ready(function () {

  // // Populate DataTable
  // let table = $("#dataTable").DataTable({
  //   data: apartmentData,
  //   paging: true,
  //   lengthChange: false,
  //   pageLength: 10,
  //   searching: true,
  //   ordering: true,
  //   info: true,
  //   autoWidth: false,
  //   language: {
  //     paginate: {
  //       previous: '<span class="prev-icon">< Poprzednia</span>',
  //       next: '<span class="next-icon">Następna > </span>',
  //     },
  //   },

  //   columnDefs: [{ orderable: false, targets: [6, 7, 8, 9] }],
  //   columns: [
  //     { data: "apartment" },
  //     { data: "area" },
  //     { data: "floor" },
  //     { data: "rooms" },
  //     {
  //       data: "balcony",
  //       render: function (data, type, row) {
  //         // If hasGarden is true, add leaf icon
  //         const leafIcon = row.hasGarden ? getLeafIcon() : "";
  //         return `${leafIcon} ${data}`;
  //       },
  //     },
  //     {
  //       data: "status",
  //       render: function (data) {
  //         let statusClass = "";
  //         if (data === "Dostępne") statusClass = "status-available";
  //         else if (data === "Rezerwacja") statusClass = "status-reserved";
  //         else if (data === "Sprzedane") statusClass = "status-sold";
  //         return '<span class="' + statusClass + '">' + data + "</span>";
  //       },
  //     },
  //     { data: "plans" },
  //     {
  //       data: "price",
  //       render: function (data) {
  //         return '<button class="price-btn">' + data + "</button>";
  //       },
  //     },
  //     {
  //       data: "promotion",
  //       render: function (data) {
  //         return data ? '<span class="usd">$</span>' : "-";
  //       },
  //     },
  //     {
  //       data: "favorite",
  //       render: function (data, type, row, meta) {
  //         return (
  //           '<button class="favorite-btn favorite-toggle" data-index="' +
  //           meta.row +
  //           '"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.46941 15.7591L7.85634 15.2682L7.46941 15.7591ZM10.0013 4.58386L9.551 5.01728C9.66882 5.13969 9.8314 5.20886 10.0013 5.20886C10.1712 5.20886 10.3338 5.13969 10.4516 5.01728L10.0013 4.58386ZM12.5332 15.7591L12.9201 16.2499L12.5332 15.7591ZM7.85634 15.2682C6.59329 14.2726 5.21219 13.3002 4.11654 12.0665C3.04232 10.8569 2.29297 9.44542 2.29297 7.61425H1.04297C1.04297 9.83553 1.96838 11.53 3.1819 12.8965C4.37399 14.2388 5.89361 15.3127 7.08248 16.2499L7.85634 15.2682ZM2.29297 7.61425C2.29297 5.82186 3.30578 4.31877 4.68827 3.68683C6.03136 3.0729 7.83602 3.23548 9.551 5.01728L10.4516 4.15044C8.41672 2.03627 6.05471 1.68782 4.1686 2.54997C2.3219 3.3941 1.04297 5.35419 1.04297 7.61425H2.29297ZM7.08248 16.2499C7.50935 16.5864 7.96759 16.9452 8.43199 17.2166C8.89618 17.4879 9.42597 17.7083 10.0013 17.7083V16.4583C9.7433 16.4583 9.43975 16.3577 9.06264 16.1374C8.68574 15.9171 8.2947 15.6138 7.85634 15.2682L7.08248 16.2499ZM12.9201 16.2499C14.109 15.3127 15.6286 14.2388 16.8207 12.8965C18.0342 11.53 18.9596 9.83553 18.9596 7.61425H17.7096C17.7096 9.44542 16.9603 10.8569 15.8861 12.0665C14.7904 13.3002 13.4093 14.2726 12.1463 15.2682L12.9201 16.2499ZM18.9596 7.61425C18.9596 5.35419 17.6807 3.3941 15.834 2.54997C13.9479 1.68782 11.5859 2.03627 9.551 4.15044L10.4516 5.01728C12.1666 3.23548 13.9712 3.0729 15.3143 3.68683C16.6968 4.31877 17.7096 5.82186 17.7096 7.61425H18.9596ZM12.1463 15.2682C11.7079 15.6138 11.3169 15.9171 10.94 16.1374C10.5628 16.3577 10.2593 16.4583 10.0013 16.4583V17.7083C10.5766 17.7083 11.1064 17.4879 11.5706 17.2166C12.035 16.9452 12.4933 16.5864 12.9201 16.2499L12.1463 15.2682Z" fill="#868686"/></svg></button>'
  //         );
  //       },
  //     },
  //   ],
  // });


})(jQuery);