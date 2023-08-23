<x-modal-confirm
{{--    eventToOpenModal="custom-show-delete-modal"--}}
    LiveWireeventToOpenModal="deleteCommentWasSet"
    eventToCloseModal="commentWasDeleted"
    modalTitle="Delete Comment"
    modalDescription="Are you sure you want to delete this Comment? this action can not be undo"
    modalConfirmButtonText="Delete"
    wireClick="deleteComment"
/>
