import { VisibilityFilter } from './action'

const initialState = {
    visibilityFilter: VisibilityFilters.SHOW_ALL,
    todos: []
};

function todoApp(state, action) {
    if (typeof state === 'undefined') {
        return initialState;
    }

    // 这里暂不处理任何action
    // 仅返回传入的state
    return state;
}
