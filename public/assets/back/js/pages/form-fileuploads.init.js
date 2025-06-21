$(".dropify").dropify({
    messages: {
        default: "Drag & drop file kesini atau klik disini",
        replace: "Drag & drop atau klik untuk replace",
        remove: "Hapus",
        error: "Ooops, something wrong appended."
    },
    error: {
        fileExtension: "File yang dibolehkan hanya dokumen (type {{ value }}).",
        fileSize: "File size terlalu besar (maksimal hanya {{ value }})."
    }
});