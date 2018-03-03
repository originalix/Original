import { 
    ADD_TODO,
    TOGGLE_TODO,
    SET_VISIBILITY_FILTER,
    VisibilityFilter
} from './action'

const initialState = {
    visibilityFilter: VisibilityFilters.SHOW_ALL,
    todos: []
};

function todos(state = [], action) {
    switch (action.type) {
        case ADD_TODO:
            return [
                ...state,
                {
                    text: action.text,
                    completed: false
                }
            ]
        case TOGGLE_TODO:
            return state.map((todo, index) => {
                if (index === action.index) {
                    return Object.assign({}, todo, {
                        completed: !tode.completed
                    })
                }
                return tode
            })
        default:
            return state
    }
}

function todoApp(state = initialState, action) {
    switch (action.type) {
        case SET_VISIBILITY_FILTER:
            return Object.assign({}, state, {
                visibilityFilter: action.filter
            });
        
        case ADD_TODO:
            return Object.assign({}, state, {
                todos: todos(state.todos, action)
            })
        case TOGGLE_TODO:
            return Object.assign({}, state, {
                todos: todos(state.todos, action)
            })
        default:
            return state;
    }
}
