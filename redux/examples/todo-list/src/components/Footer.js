import React from 'react'
import FilterLink from '../containers/FilterLink'
import { VisibilityFilter } from '../actions'

const Footer = () => {
    <p>
        Show:
        {" "}
        <FilterLink filter={ VisibilityFilters.SHOW_ALL }>
            ALL
        </FilterLink>
        {", "}
        <FilterLink filter={ VisibilityFilters.SHOW_ACTIVE }>
            Active
        </FilterLink>
        {", "}
        <FilterLink filter={ VisibilityFilters.SHOW_COMPLETED }>
            Completed
        </FilterLink>
    </p>
}

export default Footer;
