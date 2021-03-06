# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import Event from 'beatmap-discussions/event'
import * as React from 'react'
import { div, h2, a, img } from 'react-dom-factories'
el = React.createElement

export class Events extends React.Component
  render: =>
    div className: 'page-extra',
      h2 className: 'title title--page-extra', osu.trans('users.show.extra.events.title_longer')
      div className: 'modding-profile-list',
        if @props.events.length == 0
          div className: 'modding-profile-list__empty', osu.trans('users.show.extra.none')
        else
          div className: 'beatmapset-events beatmapset-events--profile',
            [
              for event in @props.events
                if !event.beatmapset
                  continue

                div className: 'beatmapset-events__event', key: event.id,
                  el Event,
                    event: event
                    mode: 'profile'
                    users: @props.users

              a
                className: 'modding-profile-list__show-more'
                key: 'show-more'
                href: laroute.route('users.modding.events', {user: @props.user.id}),
                osu.trans('users.show.extra.events.show_more')
            ]


  typeForTranslation: (event) =>
    if event.type == 'disqualify' && !_.isArray(event.comment)
      'disqualify_legacy'

    event.type
