// 인덱스 페이지 카테고리 서치 이벤트
$(document).ready(function () {
    $("#category_name").on("change", function () {
        var get_Selected_category = $(this).find(":selected").text().trim();
        if (get_Selected_category) {
            const xml_http_request = new XMLHttpRequest();
            xml_http_request.open(
                "GET",
                `/brand/by-category/${get_Selected_category}`,
                true
            );
            xml_http_request.send();
            xml_http_request.onreadystatechange = function () {
                if (xml_http_request.readyState == XMLHttpRequest.DONE) {
                    const content_type =
                        xml_http_request.getResponseHeader("Content-Type");
                    if (content_type === "application/json") {
                        const data = JSON.parse(
                            xml_http_request.responseText
                        );
                        $("#brand_id").empty();
                        $("#brand_id").focus;
                        $("#brand_id").append(
                            '<option value="">브랜드를 선택해주세요.</option>'
                        );
                        $.each(data["data"], function (key, value) {
                            $('select[id="brand_id"]').append(
                                '<option value="' +
                                value.brand_id +
                                '">' +
                                value.brand_name +
                                "</option>"
                            );
                        });
                    } else if (
                        content_type === "text/html; charset=UTF-8"
                    ) {
                        console.log();
                    }
                } else {
                    $("#brand_id").empty();
                }
            };
        }
    });
});

// 인덱스 페이지 내 아이템 추가 모달 내의 카테고리 서치 이벤트
$(document).ready(function () {
    $("#category_name_create").on("change", function () {
        var get_Selected_category = $(this).find(":selected").text().trim();
        if (get_Selected_category) {
            $.ajax({
                url: "/brand/by-category/" + get_Selected_category,
                type: "GET",
                dataType: "Json",
                success: function (data) {
                    if (data) {
                        $("#brand_id_create").empty();
                        $("#brand_id_create").focus;
                        $("#brand_id_create").append(
                            '<option value="">브랜드를 선택해주세요.</option>'
                        );
                        $.each(data["data"], function (key, value) {
                            $('select[id="brand_id_create"]').append(
                                '<option value="' +
                                value.brand_id +
                                '">' +
                                value.brand_name +
                                "</option>"
                            );
                        });
                    } else {
                        $("#brand_id_create").empty();
                    }
                },
            });
        } else {
            $("#brand_id_create").empty();
        }
    });
});

// 아이템 추가 모달 내의 아이템 생성
function createItemInModal() {
    const form = document.getElementById("item-create-form");
    form.onsubmit = function () {
        const formData = new FormData(form);
        console.log(formData);
        const xml_http_request = new XMLHttpRequest();
        xml_http_request.open("POST", `/item/store`, true);
        xml_http_request.setRequestHeader(
            "X-CSRF-TOKEN",
            $('meta[name="csrf-token"]')
        );
        xml_http_request.send(formData);
        xml_http_request.onreadystatechange = function () {
            if (
                xml_http_request.readyState === XMLHttpRequest.DONE &&
                xml_http_request.status !== 0
            ) {
                if (xml_http_request.status === 200) {
                    const modal = document.getElementById("exampleModal");
                    // const bootstrap_modal = bootstrap.Modal.getInstance(modal);
                    // bootstrap_modal.hide();
                    const item_container =
                        document.getElementById("item-container");
                    // item_container.remove();
                    xml_http_request.open("GET", "/items", true);
                    xml_http_request.send();
                    xml_http_request.onreadystatechange = function () {
                        if (
                            xml_http_request.readyState ===
                            XMLHttpRequest.DONE &&
                            xml_http_request.status !== 0
                        ) {
                            if (xml_http_request.status === 200) {
                                const content_type =
                                    xml_http_request.getResponseHeader(
                                        "Content-Type"
                                    );
                                if (content_type === "application/json") {
                                    const data = JSON.parse(
                                        xml_http_request.responseText
                                    );
                                    $('#exampleModal').modal('hide');
                                    window.alert(`상품 추가 성공`);
                                    window.location.href = '/item'
                                }
                            }
                        }
                    };
                } else {
                    $('#exampleModal').modal('hide');
                    window.alert(`상품 추가 시 오류가 발생했습니다. 오류 코드 : ${xml_http_request.status}`);
                }
            }
        };
        return false; //중요! false를 리턴해야 버튼으로 인한 submit이 안된다.
    };
}


// 카테고리 생성 로직
const form = document.getElementById("category_create_form");
if (form) {
    form.onsubmit = function () {
        const formData = new FormData(form);
        const xml_http_request = new XMLHttpRequest();
        xml_http_request.open("POST", `/category`, true);
        xml_http_request.setRequestHeader(
            "X-CSRF-TOKEN",
            $('meta[name="csrf-token"]')
        );
        xml_http_request.send(formData);
        xml_http_request.onload = function () {
            switch (xml_http_request.status) {
                case 200:
                    const data = JSON.parse(xml_http_request.responseText);
                    window.alert('카테고리 추가 성공')
                    window.location.href = '/category';
                    break;
                case 409:
                    window.alert('중복된 카테고리 입니다.')
                    window.location.href = '/category';
                    break;
            }
        };
        return false; //중요! false를 리턴해야 버튼으로 인한 submit이 안된다.
    };
}


// 카테고리 수정 모달 로드
$('#category_edit_modal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const category_id = button.data('category_id');
    const modal = $(this);
    const xhr = new XMLHttpRequest();
    // 초기화
    xhr.open("GET",
        `/category/detail/${category_id}`,
        true);
    xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]'));
    //요청
    xhr.send();
    xhr.onload = function () {
        if (xhr.status != 200) {
            // analyze HTTP status of the response
            alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
        } else {
            //데이터의 타입 확인
            const content_type = xhr.getResponseHeader("Content-Type");
            //데이터의 타입이 json일 때
            if (content_type === "application/json") {
                const data = JSON.parse(xhr.responseText);
                $('#category_edit_form').attr('action', `http://localhost/category/detail/edit/${category_id}`);
                $('#category_edit_id').val(category_id);
                $('#category_edit_name').val(data["data"][0].name);
                $('#brand_edit_name').val(data["data"][0].brand_id);
                $('#brand_edit_name').text(data["data"][0].brand_name);
            }
        }
    };
})


// 카테고리 수정 로직
const category_edit_form = document.getElementById("category_edit_form");
if (category_edit_form) {
    category_edit_form.onsubmit = function () {
        const formData = new FormData(category_edit_form);
        const xml_http_request = new XMLHttpRequest();
        xml_http_request.open("POST", `/category/detail/edit/${formData.get('category_id')}`, true);
        xml_http_request.setRequestHeader(
            "X-CSRF-TOKEN",
            $('meta[name="csrf-token"]')
        );
        xml_http_request.send(formData);
        xml_http_request.onload = function () {
            console.log(xml_http_request.responseText)
            switch (xml_http_request.status) {
                case 200:
                    const data = JSON.parse(xml_http_request.responseText);
                    window.alert('카테고리 수정 성공')
                    window.location.href = '/category';
                    break;
                case 409:
                    window.alert('중복된 카테고리 입니다.')
                    window.location.href = '/category';
                    break;
            }
        };
        return false; //중요! false를 리턴해야 버튼으로 인한 submit이 안된다.
    };
}



function get(method, url, action) {
    const xhr = new XMLHttpRequest();
    // 초기화
    xhr.open(method, url, true);
    xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]'));
    //요청
    xhr.send();
    xhr.onload = function () {
        if (xhr.status != 200) {
            // analyze HTTP status of the response
            alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
        } else {
            //데이터의 타입 확인
            const content_type = xhr.getResponseHeader("Content-Type");
            //데이터의 타입이 json일 때
            if (content_type === "application/json") {
                const data = JSON.parse(xhr.responseText);
                action(data);
            }
        }
    };

    // xhr.onprogress = function (event) {
    //     if (event.lengthComputable) {
    //         alert(`Received ${event.loaded} of ${event.total} bytes`);
    //     } else {
    //         alert(`Received ${event.loaded} bytes`); // no Content-Length
    //     }
    // };

    xhr.onerror = function () {
        alert("Request failed");
    };
}

function action(data) {
    // console.log(data);
    const modal = document.getElementById("exampleModal");
    const bootstrap_modal = bootstrap.Modal.getInstance(modal);
    bootstrap_modal.hide();
    const item_container = document.getElementById("item-container");
    item_container.remove();
}


// function changeDropDownInModal() {
//     $(document).ready(function () {
//         $("#category_name_create").on("change", function () {
//             var get_Selected_category = $(this).find(":selected").text().trim();
//             if (get_Selected_category) {
//                 $.ajax({
//                     url: "/brand/by-category/" + get_Selected_category,
//                     type: "GET",
//                     dataType: "Json",
//                     success: function (data) {
//                         if (data) {
//                             $("#brand_id_create").empty();
//                             $("#brand_id_create").focus;
//                             $("#brand_id_create").append(
//                                 '<option value="">브랜드를 선택해주세요.</option>'
//                             );
//                             $.each(data["data"], function (key, value) {
//                                 $('select[id="brand_id_create"]').append(
//                                     '<option value="' +
//                                         value.brand_id +
//                                         '">' +
//                                         value.brand_name +
//                                         "</option>"
//                                 );
//                             });
//                         } else {
//                             $("#brand_id_create").empty();
//                         }
//                     },
//                 });
//             } else {
//                 $("#brand_id_create").empty();
//             }
//         });
//     });
// }
