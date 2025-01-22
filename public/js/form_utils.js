function add_field(node) {
    let content = node.get("data-content");
    let container = node.closest("section");
    let init = node.get("data-init") ?? 0;
    let flag = container.$(".append_flag")[0];
    flag.insert(0, content.replaceAll("__id__", ++init));
    node.set("data-init", init);
}

function add_multi_fields(node) {
    let container = node.closest("section");
    let add_field_btn = container.$(".add_field")[0];
    let count = prompt("Number of fields to add: ");
    for (let i = 0; i < count; i++) add_field(add_field_btn);
}

function fill_multiple(node) {
    let container = node.closest("section");
    let add_field_btn = container.$(".add_field")[0];
    let flag = container.$(".append_flag")[0];
    let items = prompt("Add data seperated by lines: ");
    if (!items) return;
    items = items
        .split("\r\n")
        .map((x) => x.trim())
        .filter((x) => x);
    for (let i = 0; i < items.length; i++) {
        add_field(add_field_btn);
        let last_added = flag.previousElementSibling;
        let inputs = last_added.$("input");
        if (inputs.length > 1) {
            let data = items[i]
                .split(",")
                .map((x) => x.trim())
                .filter((x) => x);
            for (let j = 0; j < data.length; j++) {
                if (!data[j] || !inputs[j]) break;
                inputs[j].value = data[j];
            }
        } else {
            inputs[0].value = items[i];
        }
    }
}

function clone_section(node) {
    let container = node.closest("section");
    container.insert(3, container.cloneNode(true));
    node.remove();
}
